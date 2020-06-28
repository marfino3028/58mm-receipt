
<?php
//https://github.com/mike42/escpos-php/issues/239 (tutor)
require './vendor/autoload.php';

use Mike42\Escpos;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;

function addSpaces($string = '', $valid_string_length = 0) {
    if (strlen($string) < $valid_string_length) {
        $spaces = $valid_string_length - strlen($string);
        for ($index1 = 1; $index1 <= $spaces; $index1++) {
            $string = $string . ' ';
        }
    }

    return $string;
}

$connector = new WindowsPrintConnector("posprinter");
$printer = new Printer($connector);

// Header Penjual
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setTextSize(1, 1);
$printer -> text("INTANAKA SYAR'I \n");
$printer -> text("BTC LT 1 BLOK A1 NO. 27-29 SOLO\n");
$printer -> text("082223500029\n");

// Header Pembeli

$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(addSpaces('Waktu Penjualan', 25) . addSpaces('Kasir', 7));
$printer->text(addSpaces(date('d:m:y h:i'), 25) . addSpaces('Thesya', 5)."\n");
$printer -> text("\n");
$printer -> text("Pelanggan : NAYLA\n");
$printer -> text("\n");
$printer -> text("#CB0E20010200012836");

// Item & Jumlah
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer -> text("--------------------------------");
$printer->text(addSpaces('Item', 22) . addSpaces('Jumlah', 10));
$printer -> text("--------------------------------");
$printer->setEmphasis(false);

// Isi Item
// loop disini
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("ARAFAH ( L )\n");
$printer -> text("MATCHA\n");
$printer->text(addSpaces('      180.000 x1', 22) . addSpaces('180.000', 10));
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("SAFAYA ( L )\n");
$printer -> text("MAGENTA\n");
$printer->text(addSpaces('      205.000 x1', 22) . addSpaces('205.000', 10));
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("ARAFAH ( L )\n");
$printer -> text("HITAM\n");
$printer->text(addSpaces('      180.000 x1', 22) . addSpaces('180.000', 10));
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("ARAFAH ( L )\n");
$printer -> text("PURPLE\n");
$printer->text(addSpaces('      180.000 x1', 22) . addSpaces('180.000', 10));
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("MADINA ( L )\n");
$printer -> text("HITAM\n");
$printer->text(addSpaces('      165.000 x1', 22) . addSpaces('165.000', 10));
// loop sampe sini ya
$printer -> text("--------------------------------");

// sub total
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(addSpaces('Subtotal', 23) . addSpaces('910.000', 12));

// sub total
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(addSpaces('Disc.', 23) . addSpaces('-25.000', 12));

// Grand Total
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(addSpaces('Grand Total', 20) . addSpaces('Rp 885.000', 10). "\n");
$printer->setEmphasis(false);
$printer->text(addSpaces('TRANSFER BCA', 20) . addSpaces('Rp 885.000', 10)."\n");
$printer->text("\n");
$printer->text("Jumlah Item: 5\n");

// point
$printer->feed();
$printer->setPrintLeftMargin(0);
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(addSpaces('Point Awal', 23) . addSpaces('54', 9));
$printer->text(addSpaces('Point didapat', 23) . addSpaces('1', 9));
$printer->text(addSpaces('Total Point', 23) . addSpaces('55', 12). "\n");

// Footer
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("Jazzakillah Khair..\n");
$printer->text("Barang yang sudah dibeli\n");
$printer->text("Tidak dapat ditukar\n");
$printer->text("Atau dikembalikan...\n");

$printer->text("\n");
$printer->text("Powered by Hamz. Technology\n");
$printer->text("\n");
$printer->text("\n");

// gunakan jika isi item banyak :)
// $items = [];
// $items[] = [
//     'name' => 'The name of the product 1 goes here',
//     'qtyx_price' => '190.000',
//     'total_price' => '190.000',
//     'igst' => '14.00',

// ];
// $items[] = [
//     'name' => 'The name of the product 2 goes here',
//     'qtyx_price' => '200.00',
//     'total_price' => '200.00',
//     'jumlah' => '14.00',
// ];

// foreach ($items as $item) {

//     //Current item ROW 1
//     $name_lines = str_split($item['name'], 15);
//     foreach ($name_lines as $k => $l) {
//         $l = trim($l);
//         $name_lines[$k] = addSpaces($l, 20);
//     }

//     $qtyx_price = str_split($item['qtyx_price'], 15);
//     foreach ($qtyx_price as $k => $l) {
//         $l = trim($l);
//         $qtyx_price[$k] = addSpaces($l, 20);
//     }

//     $total_price = str_split($item['total_price'], 8);
//     foreach ($total_price as $k => $l) {
//         $l = trim($l);
//         $total_price[$k] = addSpaces($l, 8);
//     }

//     $counter = 0;
//     $temp = [];
//     $temp[] = count($name_lines);
//     $temp[] = count($qtyx_price);
//     $temp[] = count($total_price);
//     $counter = max($temp);

//     for ($i = 0; $i < $counter; $i++) {
//         $line = '';
//         if (isset($name_lines[$i])) {
//             $line .= ($name_lines[$i]);
//         }
//         if (isset($qtyx_price[$i])) {
//             $line .= ($qtyx_price[$i]);
//         }
//         if (isset($total_price[$i])) {
//             $line .= ($total_price[$i]);
//         }
//         $printer->text($line . "\n");
//     }

//     //Current item ROW 2
//     $igst_lines = str_split($item['igst'], 15);
//     foreach ($igst_lines as $k => $l) {
//         $l = trim($l);
//         $igst_lines[$k] = addSpaces($l, 20);
//     }

//     $cgst_price = str_split($item['cgst'], 28);
//     foreach ($cgst_price as $k => $l) {
//         $l = trim($l);
//         $cgst_price[$k] = addSpaces($l, 28);
//     }


//     $counter = 0;
//     $temp = [];
//     $temp[] = count($igst_lines);
//     $temp[] = count($cgst_price);
//     $counter = max($temp);

//     for ($i = 0; $i < $counter; $i++) {
//         $line = '';
//         if (isset($igst_lines[$i])) {
//             $line .= ($igst_lines[$i]);
//         }
//         if (isset($cgst_price[$i])) {
//             $line .= ($cgst_price[$i]);
//         }

//         $printer->text($line . "\n");
//     }

//     //Current item ROW 3
//     $mrp_lines = str_split($item['mrp'], 15);
//     foreach ($mrp_lines as $k => $l) {
//         $l = trim($l);
//         $mrp_lines[$k] = addSpaces($l, 20);
//     }

//     $upr_price = str_split($item['upr'], 28);
//     foreach ($upr_price as $k => $l) {
//         $l = trim($l);
//         $upr_price[$k] = addSpaces($l, 28);
//     }


//     $counter = 0;
//     $temp = [];
//     $temp[] = count($mrp_lines);
//     $temp[] = count($upr_price);

//     $counter = max($temp);

//     for ($i = 0; $i < $counter; $i++) {

//         $line = '';

//         if (isset($mrp_lines[$i])) {
//             $line .= ($mrp_lines[$i]);
//         }

//         if (isset($upr_price[$i])) {
//             $line .= ($upr_price[$i]);
//         }

//         $printer->text($line . "\n");
//     }
//     $printer->feed();
// }

$printer->cut();
$printer->pulse();
$printer->close();
?>
