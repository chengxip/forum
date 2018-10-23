<?php
namespace GFSS;

use TCPDF;

class Pdf extends TCPDF{

    protected $apple_hq = null;
    protected $apple_sold_to = null;

    public function setApple($hq,$sold_to){
        $this->apple_hq = $hq;
        $this->apple_sold_to = $sold_to;
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10,'HQID: '.$this->apple_hq , 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10,'Apple ID: '.$this->apple_sold_to , 0, false, 'L', 0, '', 0, false, 'T', 'M');


    }


    public function table(){
        define ('K_PATH_MAIN', storage_path('/'));
        $pdf = new \GFSS\Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator('BMT');
        $pdf->SetAuthor('Apple @ BMT');
        $pdf->SetTitle('Rebate Letter');
        $pdf->SetSubject('Rebate Letter');
        $pdf->setPrintHeader(false);
        //$pdf->setPrintFooter(false);

        // LEFT TOP RIGHT
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //$pdf->SetMargins(20, 20, 15);

        // add a page
        $pdf->AddPage();

        //  $pdf->SetFont('droidsansfallback', 'B', 16);


        //$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
        //$pdf->SetFont('droidsansfallback', '', 10,'',TRUE);
    /*

    $pdf->Ln();

    $tbl = '
<p>甲方（出借人）：</p>
<br/>
';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    $pdf->Ln();

    $tbl='
<table border="0.1" cellpadding="4" style="font-size:.8em" >
<tr><td colspan="3" style="padding:2px">总金额</td><td></td></tr>
<tr><td colspan="3">总金额</td><td></td></tr>
<tr><td colspan="3">总金额</td><td></td></tr>
<tr><td colspan="3">
<p>Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!</p>
 <p>運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！</p></td><td align="center" valign="middle"> 123,456.78 </td></tr>
<tr><td colspan="3">总金额</td><td></td></tr>
</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
     */
        //  $pdf->SetFont('droidsansfallback', '', 10,'',TRUE);
        $pdf->SetFont('cid0cs', '', 10,'',TRUE);

        $pdf->Cell(0, 0, 'TEST CELL STRETCH: no stretch', 0, 1, 'L', 0, '', 0);
        $pdf->Cell(0, 0, '尊敬的[深圳爱施德科技有限公司]', 0, 1, 'L', 0, '', 0);

        $pdf->SetFont('cid0ct', '', 10,'',TRUE);

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $txt = 'tx';
        $border = 1;
        $autopadding = 10;
        $left = 132;
        $right = 45;
        $x =  '';
        $pdf->SetLineWidth(0.1);
        $pdf->SetDrawColor(82, 86, 89);
        $pdf->setCellPaddings(1, 1, 1, 1);
        $pdf->SetFillColor(220, 255, 220);
        $pdf->MultiCell($left, 20, 'Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!
            運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！'.$txt, $border, 'L', 0, 0, $x, '', true, 0, false, true, 20 , 'M');
        $pdf->MultiCell($right, 20, '123,456.78    ', $border, 'R', 0, 0, '', '', true, 0, false, true, 20 , 'M');
        $pdf->Ln();

        $pdf->MultiCell($left, 20, 'Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!
            運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！'.$txt, $border, 'L', 0, 0, $x, '', true, 0, false, true, 20 , 'M');
        $pdf->MultiCell($right, 20, '123,456,789.00    ', $border, 'R', 0, 0, '', '', true, 0, false, true, 20 , 'M');
        $pdf->Ln();

        $pdf->MultiCell($left, 20, 'Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!
            運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！'.$txt, $border, 'L', 0, 0, $x, '', true, 0, false, true, 20 , 'M');
        $pdf->MultiCell($right, 20, '123,456,789.00    ', $border, 'R', 0, 0, '', '', true, 0, false, true, 20 , 'M');
        $pdf->Ln();

        $pdf->MultiCell($left, 20, 'Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!
            運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！'.$txt, $border, 'L', 0, 0, $x, '', true, 0, false, true, 20 , 'M');
        $pdf->MultiCell($right, 20, '我踏月色而來 123,456,789.00    ', $border, 'R', 0, 0, '', '', true, 0, false, true, 20 , 'M');
        $pdf->Ln();



        $pdf->setApple('32842323','000002340238');

        // set some text to print
        $txt = <<<EOD
運氣，話嚟就嚟！只須鍵入一個心水號碼然後按加入注項電腦便會隨機加入五個運財號碼方便你即時購買六合彩！
TCPDF Example 002

Great book just out, "A Place Called Heaven," by Dr. Robert Jeffress - A wonderful man!
Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
我踏月色而來。
EOD;

        // print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);


        $pdf->Output('agreement.pdf', 'I');

    }
} 
