<?php
class Application_Model_Bestellingheader extends My_Model
{
    protected $_name = 'bestellingheader'; //table name
    protected $_id = 'id'; //primary key
    protected $dataGrid;

    public function init()
    {
        parent::init();
    }

    public function save($data,$id = NULL)
    {
    	$currentTime =  date("Y-m-d H:i:s", time());
        $dbFields = array(
        	'IDGebruiker'       => $data['IDGebruiker'],
                'datumbestelling'   => $currentTime,
                'referentie'        => $data['referentie'],
                'leveringsadres'    => "...",
                'status'            => 1
        );

        return $this->insert($dbFields);                               
    }

    
    public function insert($data)
    {
	     return parent::insert($data);       
    }

    /**
     * Update
     * @return int numbers of rows updated
     */
    public function update($data,$id)
    {
        return parent::update($data, 'id = '. (int)$id);
    }

    

    public function getAantalBestellingen($userid=null)
    {
            $sql = $this->db
            ->select()
            ->from(array('h' => 'bestellingheader'), array('count(id) as aantalbestellingen') );
            $sql->where ('h.IDGebruiker = '.(int)$userid);
            $data = $this->db->fetchAll($sql);
            if (!empty($data)) {
                return current($data);
            } else {
                return null;
            }
    }

    public function getTotaalBestellingen($userid=null)
    {
            $sql = $this->db
            ->select()
            ->from(array('h' => 'bestellingheader'), array('id','datumbestelling', 'referentie','status','IDGebruiker') )
            ->join(array('d' => 'bestellingdetail'), ' h.id = d.IDBestelling  ', array('sum(totaal) as totaal') )
            ->group(array('id','datumbestelling', 'referentie','status','IDGebruiker') );
            if (!empty($userid)) {
                $sql->where ('h.IDGebruiker = '.(int)$userid);
            }
            $data = $this->db->fetchAll($sql);
            return $data;
    }

    public function getBestellingen($bestellingid=null)
    {
            $locale= Zend_Registry::get('Zend_Locale');
            $taalcode=(!empty($locale))?substr($locale,0,2):'nl';
            $sql = $this->db
            ->select()
            ->from(array('h' => 'bestellingheader'), array('id','datumbestelling', 'referentie','status',) )
            ->join(array('d' => 'bestellingdetail'), ' h.id = d.IDBestelling  ', array('IDProduct','AantalBesteld','Prijs','Totaal') )
            ->join(array('p' => 'product'), ' p.id = d.IDProduct  ', array('label') )
            ->join(array('v' => 'product_vertaling'), ' p.id = v.product_id  ', array('titel','teaser','inhoud','vertaald', 'taal_id') )
            ->join(array('u' => 'gebruiker'), ' u.id = h.IDGebruiker  ', array('naam','email') )
            ->join(array('t' => 'taal'), ' t.id = v.taal_id  ', array('code', 'status as t.satus') );;
            $sql->where ('t.code = '."'".$taalcode."'");
            if (!empty($bestellingid)) {
                $sql->where ('h.id = '.(int)$bestellingid);
            }
            $data = $this->db->fetchAll($sql);
            return $data;
    }

    public function buildDataGrid($source_array) {
                $dataGrid       = new My_DataGrid();
                $this->dataGrid = $dataGrid->getGrid();

                $source = new Bvb_Grid_Source_Array($source_array, array('id', 'datumbestelling', 'referentie', 'status', 'totaal'));
                $this->dataGrid->setTableGridColumns(array('id', 'datumbestelling', 'referentie','status', 'totaal'));

    		$this->dataGrid->setSource($source);

 		$filters = new Bvb_Grid_Filters();
                $filters->addFilter('status',array('values' => array(1 => '1=Bestelling ontvangen', 2 => '2=Bestelling geleverd' ) ));

                $this->dataGrid->updateColumn('id',array('style' => 'width:10px;text-align:center;','decorator' => '<a href="/winkelmand/showPdf/id/{{id}}">{{id}}</a>'));
                $this->dataGrid->updateColumn('totaal',array('style' => 'text-align:right;','format' => 'Number'));

                $filters->addFilter('id');
                $filters->addFilter('referentie');

                $this->dataGrid->addFilters($filters);
                $this->dataGrid->setRecordsPerPage(25);
        	return $this->dataGrid->deploy();
    }


     public function buildPdf($bestelling,$id){
		// create new PDF document
			$pdf = new My_Tcpdf('L', PDF_UNIT, PDF_PAGE_FORMAT, true); //default is UTF-8
			$currentDate = date('d.m.Y');
                // set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("TV");
			$pdf->SetTitle('Bestelling');
			$pdf->SetSubject('Bestelling');
			$pdf->SetPrintHeader(false);

		// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN,'', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA,'', PDF_FONT_SIZE_DATA));

		//set margins
			$pdf->SetMargins(5, 2, PDF_MARGIN_RIGHT); //PDF_MARGIN_TOP
			$pdf->SetHeaderMargin(0);
                        $pdf->SetFooterMargin(0);
			/*$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);*/

		//set auto page breaks
                /*$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);*/
		$pdf->SetAutoPageBreak(true,5);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf->AliasNbPages();

                $counter=0;
                $totaal =0;
                $pdf->AddPage("P","A4");
                $pdf->SetFont('helvetica','',10);
                $this->printHeader($pdf, $bestelling);
                $totaal=0;
                foreach ($bestelling as $b) { 
			$counter++;

                        $pdf->Cell(10,5,$counter,0,0,'C');
                        $pdf->Cell(50,5,$b['titel'],0,0,'L');
                        if ($b['AantalBesteld']>0) {
                            $pdf->Cell(20,5,number_format($b['AantalBesteld'],2,",",""),0,0,'R');
                        } else {
                            $pdf->Cell(20,5,'',0,0,'L');
                        }
                        if ($b['Prijs']>0) {
                            $pdf->Cell(20,5,number_format($b['Prijs'],2,",",""),0,0,'R');
                        }
                        else {
                             $pdf->Cell(20,5,'',0,0,'L');
                        }
                        $totaal+=$b['Totaal'];
                        if ($b['Totaal']>0 ) {
                            $pdf->Cell(20,5,number_format($b['Totaal'],2,",",""),0,0,'R');
                        }
                        else {
                             $pdf->Cell(20,5,'',0,0,'L');
                        }
                        $pdf->ln(5);
                }
                if ($counter>0) {
                    $this->printFooter($pdf, $totaal);
                }
    
                $fileName = "Bestelling".trim($id).'.pdf';
		$pdf->Output($fileName,'D');
    }


    private function printHeader($pdf, $bestelling)
    {
		$pdf->ln(5);
		$pdf->Cell(10,5,"Bestelbon"." : ".$bestelling[0]['id'],0,0,'L');
                $pdf->ln(5);
                $pdf->Cell(10,5,"Datum bestelling"." : ".$bestelling[0]['datumbestelling'],0,0,'L');
                $pdf->ln(5);
                $pdf->Cell(10,5,"Referentie"." : ".$bestelling[0]['referentie'],0,0,'L');
                $pdf->ln(5);
                $pdf->Cell(10,5,"Opgemaakt door"." : ".$bestelling[0]['naam']." (".trim($bestelling[0]['email']).")",0,0,'L');

                $pdf->ln(10);
                        $pdf->Cell(10,5,'Nr.',1,0,'C');
                        $pdf->Cell(50,5,'Product',1,0,'C');
                        $pdf->Cell(20,5,'Aantal',1,0,'C');
                        $pdf->Cell(20,5,'Prijs',1,0,'C');
                        $pdf->Cell(20,5,'Totaal',1,0,'C');
		$pdf->ln(5);
    }

    private function printFooter($pdf, $totaal)
    {
                $pdf->ln(10);
                        $pdf->Cell(10,5,'',0,0,'C');
                        $pdf->Cell(50,5,'',0,0,'C');
                        $pdf->Cell(20,5,'',0,0,'C');
                        $pdf->Cell(20,5,'Totaal',1,0,'R');
                        $pdf->Cell(20,5,number_format($totaal,2,",",""),1,0,'C');
		$pdf->ln(5);
    }
         
}

