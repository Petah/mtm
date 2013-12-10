<?php

// Quicksilver Score
//
// A port of the Quicksilver string ranking algorithm
// (re-ported from Javascript to PHP by Kenzie Campbell)
// http://route19.com/logbook/view/quicksilver-score-in-php
//
// score("hello world","axl") //=> 0.0
// score("hello world","ow") //=> 0.6
// score("hello world","hello world") //=> 1.0
//
// The Javascript code is available here
// http://orderedlist.com/articles/live-search-with-quicksilver-style/
// http://orderedlist.com/demos/quicksilverjs/javascripts/quicksilver.js
//
// The Quicksilver code is available here
// http://code.google.com/p/blacktree-alchemy/
// http://blacktree-alchemy.googlecode.com/svn/trunk/Crucible/Code/NSString+BLTRRanking.m
//
// The MIT License
//
// Copyright (c) 2008 Lachie Cox
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
function score($string, $abbreviation, $offset = 0) {
    $string = strtolower($string);
    $abbreviation = strtolower($abbreviation);
    if (strlen($abbreviation) == 0)
        return 0.9;
    if (strlen($abbreviation) > strlen($string))
        return 0.0;
    for ($i = strlen($abbreviation); $i > 0; $i--) {
        $sub_abbreviation = substr($abbreviation, 0, $i);
        $index = strpos($string, $sub_abbreviation);
        if ($index < 0 or $index === false)
            continue;
        if ($index + strlen($abbreviation) > strlen($string) + $offset)
            continue;
        $next_string = substr($string, $index + strlen($sub_abbreviation));
        $next_abbreviation = null;
        if ($i >= strlen($abbreviation))
            $next_abbreviation = '';
        else
            $next_abbreviation = substr($abbreviation, $i);
        $remaining_score = score($next_string, $next_abbreviation, $offset + $index);
        if ($remaining_score > 0) {
            $score = strlen($string) - strlen($next_string);
            if ($index != 0) {
                $j = 0;
                $c = ord(substr($string, $index - 1));
                if ($c == 32 || $c == 9) {
                    for ($j = ($index - 2); $j >= 0; $j--) {
                        $c = ord(substr($string, $j, 1));
                        $score -= (($c == 32 || $c == 9) ? 1 : 0.15);
                    }
                } else
                    $score -= $index;
            }
            $score += $remaining_score * strlen($next_string);
            $score /= strlen($string);
            return $score;
        }
    }
    return 0.0;
}
