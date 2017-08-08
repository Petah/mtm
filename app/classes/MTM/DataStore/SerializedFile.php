<?php
/**
 * MTM\DataStore\SerializedFile
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\DataStore;
use MTM\Exception\DataAccessException;

class SerializedFile {

    private $file;
    private $fileHandle;
    private $data;

    public function saveModel($model) {
        $id = $model->getID() ?: $this->generateID();
        $model->setID($id);
        $key = get_class($model) . ':' . $id;
        $this->data['models'][$key] = $model;
    }

    public function iterateModels($type) {
        foreach ($this->data['models'] as $model) {
            if ($model instanceof $type) {
                yield $model;
            }
        }
    }

    public function open() {
        $this->fileHandle = fopen($this->getFile(), 'c+');
        if ($this->fileHandle === false) {
            throw new DataAccessException('Could not open data store file: ' . $this->getFile());
        }
        if (!flock($this->fileHandle, LOCK_EX)) {
            throw new DataAccessException('Could not acquire lock on data store file: ' . $this->getFile());
        }
        $data = stream_get_contents($this->fileHandle);
        if ($data === false) {
            throw new DataAccessException('Could not read data store file: ' . $this->getFile());
        }
        if ($data) {
            $this->data = @unserialize($data);
        }
        if (!$this->data) {
            $this->data = [
                'next-id' => 1,
                'models' => [],
            ];
        }
    }

    public function close() {
        $data = serialize($this->data);
        ftruncate($this->fileHandle, 0);
        fseek($this->fileHandle, 0);
        fwrite($this->fileHandle, $data);
        fflush($this->fileHandle);
        flock($this->fileHandle, LOCK_UN);
        fclose($this->fileHandle);
    }

    public function generateID() {
        return $this->data['next-id']++;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

}
