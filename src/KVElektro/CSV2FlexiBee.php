<?php
/* KvElektro to FlexiBee Invoice Importer
 *
 * (The MIT license)
 * Copyright (c) 2018 Vítězslav Dvořák
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated * documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace FlexiPeeHP\KVElektro;

class CSV2FlexiBee extends \FlexiPeeHP\FakturaPrijata
{

    public function loadCSV($inputFile)
    {
        $loaded = 0;
        if (file_exists($inputFile)) {
            $inputFileDataRaw = file($inputFile);
            $splat            = new \DateTime();
            $splat->modify('+14 days'); //TODO: ???
            $this->setData([
                'uvodTxt' => 'KV Elektro',
                'popis' => $inputFile,
                'cisDosle' => str_replace('.csv', '', $inputFile),
                'datSplat' => \FlexiPeeHP\FlexiBeeRW::dateToFlexiDate($splat)
            ]);
            foreach ($inputFileDataRaw as $csvRow) {
                $rowData = str_getcsv($csvRow, ';');

                if (!empty($rowData)) {

                    $this->addArrayToBranch([
//0 => "1288247"; Objednaci Kod
                        'ciselnyKodZbozi' => $rowData[0],
//1 => "ZVONKOVY TRANSFORMATOR KTF-8-24";
                        'nazev' => $rowData[1],
//2 => "1.000";
                        'mnozMj' => $rowData[2],
//3 =>"KS";
                        'mj' => \FlexiPeeHP\FlexiBeeRO::code($rowData[3]),
//4 => "161.8";
                        'cenaMj' => floatval($rowData[4]),
//5 => "161.80";
//6 => "CZK"; 
                        'mena' => \FlexiPeeHP\FlexiBeeRO::code($rowData[6]),
//7 => "21";
                        'szbDph' => $rowData[7],
//8 => "33.98";
//9 => "";
//10 => "";
//11 => "23260"; //Dodavatelsky kod
                        'kod' => $rowData[11],
//12 => "5905339232601"; //EAN 
                        'eanKod' => $rowData[12],
//13 => "2150918839"; ??
//14 => "CC0003969974_47833" ??
                        'typPolozkyK' => 'typPolozky.obecny',
                        'typCenyDphK' => 'typCeny.sDph',
                        'typSzbDphK' => 'typSzbDph.dphZakl',
                    ]);
                    $loaded++;
                }
            }
        } else {
            $this->addStatusMessage(sprintf(_('%s: %s does not exist'),
                    getcwd(), $inputFile), 'error');
        }
        return $loaded;
    }
}
