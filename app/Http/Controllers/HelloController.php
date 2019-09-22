<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HelloController extends Controller
{
    public function index () 
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];


$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()
    ->setTitle('タイトル')
    ->setSubject('サブタイトル')
    ->setCreator('作成者')
    ->setCompany('会社名')
    ->setManager('管理者')
    ->setCategory('分類')
    ->setDescription('コメント')
    ->setKeywords('キーワード');

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'テストA1');
$sheet->getCell('A2')->setValue('テストA2');

$sheet
    ->setCellValue('A4', 10)
    ->setCellValue('A5', 5)
    ->setCellValue('A6', '=A4 + A5');

$arrayData = [
    [NULL, 2016, 2017, 2018],
    ['Q1', 12, 15, 21],
    ['Q2', 56, 73, 86],
    ['Q3', 52, 61, 69],
    ['Q4', 30, 32, 0],
];
$sheet->fromArray($arrayData, NULL, 'C3');
// 第四引数をtrueにしないと緩い比較が行われて0がnullとして扱われるため空欄になるので注意
$sheet->fromArray($arrayData, NULL, 'C9', true);


$writer = new Xlsx($spreadsheet);
$writer->save('/var/www/l5/test.xlsx');


        return view('hello', compact('hello', 'hello_array'));
    }
}
