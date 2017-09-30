## Synopsis

PT Catur Mitra Sejati Sentosa or Mitra 10 is a subsidiary of the parent company PT Catur Sentosa Adiprana (CSA), Mitra 10 operates as a distributor of building materials, one of its products is paint. Paint sales forecast is very influential in the decision to determine how much supply of paint that must exist for the sales period in the future. The stock deficiency or excess have a negative impact for the business. It required an appropriate forecasting method to predict the product sales in the future. The Weighted Moving Average method has been chosen because it is the kind of quantitative - time series, the method is very effective for horizontal data pattern (fluctuate among a constant value), does not have a trend, and do not have a seasonal pattern. Those variables are appropriate for paint sales data pattern in Mitra 10 Denpasar. This research has resulted a system that can applying the Weighted Moving Average method, with 8.21% of average forecasting error for PAINT product. This web based system, was built with PHP programming language and hugged MySQL as its DBMS. The system has been validated using Black Box Testing.

## Code Example

WMA   = (Σ Dt∗Weighted )/(Σ Weighted)
Where : Dt       -> Actual Sales on t period
      : Weighted -> Increasely weighted (begin at 1)

Pseudo Code
    
    public function calcWMA(){
        $this->pageauth->sess_auth();
        /**************************** tahap 0 ambil POST data ****************************/
        date_default_timezone_set("Asia/Singapore");
        $username = $this->session->userdata('username');
        $myCheckboxes = $this->input->post('myCheckboxes');
        $id_parPeriod2 = $this->input->post('id_parPeriod2');
        $selKat = $this->input->post('selKat');
        $selKatVal = $this->input->post('selKatVal');
        $ItmCode = $this->input->post('ItmCode');

        /**************************** tahap 1 delete insert ******************************/
        // call a function delete then insert
        $this->db->query("call f_mod_gen_forc_hist($id_parPeriod2)");
        $countchecked = count($myCheckboxes); // jumlah checkboxes yang tercentang

        /**************************** tahap 2 hitung WMA *********************************/
        $this->db->query("delete from mod_trn_forc where cat_code = '$selKatVal'");       // delete data hasil forecast
        $query3 = $this->db->query("select * from _tmp_mod_forc_hist");
        /* inisialisasi variable */
        $p = count($query3->result())-1;                    // jumlah data
        $y = $countchecked;                                 // jumlah tercentang
        $z = 0;                                             // counter 2
        $Eqw = 0;                                           // nilai awal SUM(Dt * Botot)
        $Ew  = 0;                                           // nilai awal SUM(bobot)
        // simpan data no ke array
        $arryno = array();
        foreach ($query3->result() as $row){
            $arryno[] = $row->no;
        }
        // simpan data periode ke array
        $arrymm = array();
        foreach ($query3->result() as $row){
            $arrymm[] = $row->mmmy;
        }
        // simpan data qty ke array
        $arryqty = array();
        foreach ($query3->result() as $row){
            $arryqty[] = $row->qty;
        }

        /********************************************* WEIGHTED MOVING AVERAGE *******************************************/
        $s = $y;
        for($q=0; $q<=$p; $q++){                                            // loop sebanyak data
            if($q>=$y){                                                     // jika iterasi data >= periode terpilih
                $w = 1;                                                     // nilai awal Weight
                for($n=$z; $n<=$y-1; $n++){                                 // loop sebanyak data terpilih
                                                                            // echo " (" . $arryqty[$n] . " x " . $w . ") ";
                    $qw     = $arryqty[$n] * $w;                            // WMA = Dt * Botot
                    $Eqw    = $Eqw + $qw;                                   // WMA = SUM(Dt * Botot)
                    $Ew     = $Ew + $w;                                     // WMA = SUM(Bobot)
                    $w++;                                                   // nilai weight ditambah 1 selama looping
                }
                $wma = $Eqw/$Ew;                                            // WMA = SUM(Dt * Bobot)/SUM(Bobot)
                $err = $arryqty[$q] - $wma;                                 // ERROR = (aktual qty) - WMA
                if ($err<0){
                    $mad = $err * (-1);
                } else {
                    $mad = $err;                                            // MAD = abaikan nilai minus ERROR
                }
                $mse = exp(2 * log($mad));                                  // MSE = MAD(pangkat 2)
                if($arryqty[$q]==0){
                    $mape = 0;
                } else {
                    $mape = $mad/$arryqty[$q] * 100;                        // MAPE = MAD/Aktual Qty
                    $mape = round($mape,2);
                }
                $dataforecast = array(                                      // simpan data forecast ke array
                    'record_by' => $username,
                    'record_date' => date('Y-m-d H:i:s'),
                    'cat_code' => $selKatVal,
                    'no'    => ($q+1),
                    'mmmy'  => $arrymm[$q],
                    'qty'   => $arryqty[$q],
                    'wma'   => $wma,
                    'error' => $err,
                    'MAD'   => $mad,
                    'MSE'   => $mse,
                    'MAPE'  => $mape
                );
                $this->db->insert('mod_trn_forc', $dataforecast);           // insert data forecast ke db
                $w = 0;                                                     // nilai weight kembali jadi 0 setelah looping
                $y++; $z++; $Eqw=0; $Ew=0;                                  // kembalikan variable ke 0 dan tambah 1
            } else {
                                                                            // echo "  |  " . ($q+1) . "  |  " . $arrymm[$q] . "  |  " . $arryqty[$q] . "  |  null | null | null | null | null<br>";
                $datahistory = array(                                       // simpan data history ke array
                    'record_by' => $username,
                    'record_date' => date('Y-m-d H:i:s'),
                    'cat_code' => $selKatVal,
                    'no'    => ($q+1),
                    'mmmy'  => $arrymm[$q],
                    'qty'   => $arryqty[$q],
                    'wma'   => NULL,
                    'error' => NULL,
                    'MAD'   => NULL,
                    'MSE'   => NULL,
                    'MAPE'  => NULL
                );
                $this->db->insert('mod_trn_forc', $datahistory);            // insert data history ke db
            }
    }

## Motivation

Forecasting system for paint product with Weighted Moving Average method. Designed to predict sales demand quantitatively based on periodical of sales history.

## Installation

This application was build using Codeigniter PHP Framework
1. Create new database "sirama",
2. Restore the "db_sirama_20170523.sql" sql file into it,
3. Clone this project repository into your htdoc/www web server folder,
4. Alter the application/config/database.php


## License

MIT
