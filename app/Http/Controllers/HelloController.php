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
        $hello_array = ['Hello', '����ɂ���', '�j�[�n�I'];


$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()
    ->setTitle('�^�C�g��')
    ->setSubject('�T�u�^�C�g��')
    ->setCreator('�쐬��')
    ->setCompany('��Ж�')
    ->setManager('�Ǘ���')
    ->setCategory('����')
    ->setDescription('�R�����g')
    ->setKeywords('�L�[���[�h');

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', '�e�X�gA1');
$sheet->getCell('A2')->setValue('�e�X�gA2');

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
// ��l������true�ɂ��Ȃ��Ɗɂ���r���s����0��null�Ƃ��Ĉ����邽�ߋ󗓂ɂȂ�̂Œ���
$sheet->fromArray($arrayData, NULL, 'C9', true);


$writer = new Xlsx($spreadsheet);
$writer->save('/var/www/l5/test.xlsx');


        return view('hello', compact('hello', 'hello_array'));
    }
}
