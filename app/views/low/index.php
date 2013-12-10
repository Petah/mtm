<div class="col-sm-3">
    <h3>Item</h3>
    <form id="low" action="" method="post">
        <?= $form->addMultiSelect('categories')->setLabel('Categories')->setOptionGroups($data->lowAPI->getCategories()); ?>
        <?= $form->addTextField('search')->setLabel('Search Terms')->setDescription('A few keywords to help refine your results.'); ?>
        <?= $form->addTextField('price-desired')->setLabel('Ideal Price')->setDescription('The ideal price you would like to pay.'); ?>
        <?= $form->addTextField('price-max')->setLabel('Maximum Price')->setDescription('The maximum price you are willing to pay. This is a hard limit and you will recieave no alerts of matching items over this price.'); ?>
    </form>
</div>

<div id="listings" class="col-sm-9">
</div>


<script id="low-template" type="text/x-twig">
    <div class="listing">
        <img src="{{ image }}" alt="{{ title }}" />
        <div class="listing-info">
            <h2>{{ title }}</h2>
            <table>
                <tr>
                    <th>Price</th>
                    <td>{{ price }}</td>
                </tr>
                <tr>
                    <th>Closes</th>
                    <td>{{ endDate }}</td>
                </tr>
            </table>
        </div>
    </div>
</script>
