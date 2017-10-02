<?php
	$username = $this->session->userdata('username');
	$level    = $this->session->userdata('level');
	$apptitle = $this->session->userdata('apptitle');
	$appver   = $this->session->userdata('appver');
	// session that would be inserted to database
	$ses_start  = $this->session->userdata('ses_start');
	$ses_status = $this->session->userdata('ses_status');
?>

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Transaksi</a></li>
            <li class="active">Penjualan</li>
        </ol>
	</section>


    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- modal for everything -->
            <div class="modal" id="notificationPreview" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <span id="loadingrad" style="padding-left: 41%; display: none;"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                        <div class="modal-body" id="id_mdlBdy">
                            <!-- ajax load here -->
                        </div>
                    </div>
                </div>
            </div>

            <section class="col-lg-5 connectedSortable">
                <!-- div box content left -->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-keyboard-o"></i> Entri Transaksi per Tanggal</li>
                    </ul>
                    <div class="tab-content">
                        <form id="frmAddTrnHead" class="form-horizontal">
                            <div>
                                <label for="lbl_gldate">Tanggal Bill</label>
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" class="form-control" name="txt_trndate" id="id_trndate" data-date-format="YYYY/MM/DD"/>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            <div>
                                <label for="lbl_glnum">System Bill</label>
                                <input type="text" name="txt_trnnum" class="form-control" id="id_trncode" placeholder="Auto" required>
                            </div>
                            <div>
                                <label for="lbl_glnum">Catatan</label>
                                <input type="text" name="txt_trnref" class="form-control" id="id_trnref" placeholder="Catatan..." required>
                            </div>
                        </form>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->


            <section class="col-lg-2 connectedSortable">
                <!-- div box content left -->
                <div class="nav-tabs-custom" style="height: 234px;">
                    <div class="tab-content" style="text-align: center">
                        Total Qty
                        <div id="id_TtlQty"><h1><b>0.00</b></h1></div>
                    </div>
                    <div class="tab-content" style="text-align: center">
                        Total Item
                        <div id="id_TtlItm"><h1><b>0</b></h1></div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->


            <section class="col-lg-5 connectedSortable">
                <!-- div box content left -->
                <div class="nav-tabs-custom" style="height: 234px;">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-upload"></i> Import Transaksi Dari CSV File</li>
                    </ul>
                    <div class="tab-content">
                        <div id="id_impFile">
                            <form name="frm_uploadCsv" id="id_uploadCsv">
                                Langkah-langkah import transaksi dari *.csv file
                                <p>
                                <ol>
                                    <li>Download contoh format excel *.xls/*.xlsx <a href="<?php echo base_url(); ?>assets/templ/libraries/share/import.xlsx" download="import.xlsx">import.xlsx</a></li>
                                    <li>Lengkapi data sesuai format standar.</li>
                                    <li>Save as > pilih "CSV"</li>
                                    <li><i class="fa fa-file-excel-o"></i> Import transaksi dari *.csv file.</li>
                                </ol>
                                </p>
                                <div style="display: flex; margin-top: 5px;">
                                    <input name="csv" type="file" id="csv" class="btn btn-default btn-xs" accept=".csv"/>&nbsp;&nbsp;
                                    <button class="btn btn-default btn-xs" id="id_btnImps" onclick="uploadCsv()"><i class="fa fa-check"></i>&nbsp; Upload</button>
                                </div>
                            </form>
                            <!--<span id="loadingimp" style="display: none;"><img src="<?php /*echo base_url(); */?>assets/templ/libraries/img/loading.svg">Loading...</span>-->
                            <div id="progress"></div>
                            <div id="id_staMes"><!-- ajax result load here --></div>
                        </div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </section><!-- /.Left col -->

            <!-- Main content -->
            <section class="col-lg-12 connectedSortable">
                <!-- Box Detail Bill -->
                <div id="id_boxDetBil" class="box hidden">
                    <div class="box-body">
                        <form id="frmAddTrnDetail" class="form-horizontal">
                            <!-- temporary inpput untuk menampung nilai GL Detail Row -->
                            <input type="hidden" name="txt_tmpText" id="id_tmpText" />
                            <TABLE ID="tblGlDetail" class="table table-striped table-hover dataTable">
                                <TR>
                                    <TH width="10%">Line</TH>
                                    <TH width="20%">Pilih Item</TH>
                                    <TH width="40%">Nama Item</TH>
                                    <TH width="10%" style="text-align: right">Qty Item</TH>
                                    <TH width="20%">&nbsp;</TH>
                                </TR>
                                <tr>
                                    <td><INPUT TYPE='text' id='id_trnseq' NAME='txt_trnseq' CLASS='form-control' readonly></td>
                                    <td>
                                        <div class='input-group'>
                                            <INPUT TYPE='text' NAME='txt_itmcode' CLASS='form-control' id='id_itmcode' placeholder="ketik kode item/pilih">
                                            <span data-toggle='modal' data-target='#notificationPreview' class='input-group-addon' id="id_modTgr" style="cursor: pointer"><span class='glyphicon glyphicon-folder-open'></span></span>
                                        </div>
                                    </td>
                                    <td><INPUT TYPE='text' NAME='txt_itmname' CLASS='form-control' id="id_itmname" readonly></td>
                                    <td style="text-align: right"><INPUT TYPE='number' NAME='txt_itmqty' CLASS='form-control' id="id_itmqty"></td>
                                    <td>
                                        <button class="btn btn-default btn-sm disabled" id="id_btnSave"><i class="fa fa-save"></i>&nbsp; Save</button>
                                    </td>
                                </tr>
                            </TABLE>
                            <!-- data table transaksi yang telah diinput -->
                            <span id="loadingtrn" style="padding-left: 41%"><img src="<?php echo base_url(); ?>assets/templ/libraries/img/loading.svg">Loading...</span>
                            <div id="id_tblTrnDiv">
                                <!-- ajax load here -->
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer-->
                </div><!-- /.box -->
            </section><!-- /.content -->
        </div>
    </section>
</div><!-- /.content-wrapper -->


<!-- on document ready -->
<script>
	$(document).ready(function(){
	    // set focus pertama
        $('#id_trndate').focus();
	});
    function resethead(){
        $('#id_trndate').focus();
        document.getElementById('frmAddTrnHead').reset();
    }
    function resetdetail(){
        //$('#id_itmcode').focus();
        document.getElementById('frmAddTrnDetail').reset();
    }
</script>

<!-- datetimepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/templ/libraries/js/romanize.js"></script>
<script type="text/javascript">
	$(function(){
		$('#datetimepicker1').datetimepicker({
			showClose: true,
			showTodayButton: true
		});
		/* set date picker change event */
		$("#datetimepicker1").on("dp.change", function(e) {
			// get datet picker value and use it on any commands...
			dateVal = $('#datetimepicker1').data('date');
			// get element by ID
			elementId = document.getElementById('id_trncode');
			// conver date to MM/YYYY (month/year only) || 0 = January
			var dateMM   = new Date(dateVal);
			var dateMM   = dateMM.getMonth() + 1;
			var dateMM	 = romanize(dateMM); // last value
			var dateYYYY = new Date(dateVal);
			var dateYYYY = dateYYYY.getFullYear(); // last value

            // merge document number
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/getDocNum",
                data: {
                    dateVal : dateVal
                },
                beforeSend: function(){
                    $('#loadingtrn').show();
                },
                success: function(res) {
                    console.log(res);
                    $('#loadingtrn').hide();
                    var docNum      = res + "/" + dateMM + "/" + dateYYYY;
                    elementId.value = docNum;
                    GetTtlQty();
                    GetTtlItem();
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

			document.getElementById('id_tmpText').value = dateVal;
			$("#id_boxDetBil").removeClass("hidden");
			// load table list transaksi
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/show_trn_afterdatechg",
				data: {
					dateVal: dateVal // simpan tanggal
				},
				beforeSend: function(){
					$('#loadingtrn').show();
				},
				success: function(res) {
					$('#loadingtrn').hide();
					$('#id_tblTrnDiv').html(res);
					// table configuration list transaksi
					$('#id_tblTrn').DataTable({
						"retrieve": true, // <-- mencegah error reinitilise table.
						"order": [[ 0, "desc" ]],
						"paging": false,
						"lengthChange": true,
						"searching": false,
						"ordering": true,
						"info": true,
						"autoWidth": true
					});
                    $('#id_trnref').focus();
                    resetdetail();
				},
				error: function(xhr){
					alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
				}
			});
			return false;
		});
	});
</script>


<!-- on itm_code text field ENTER -->
<script>
    $('#id_itmcode').on('keypress', function(e){
        if(e.which===13){
            var itm_code = $('#id_itmcode').val();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/show_1item",
                data: {
                    itm_code : itm_code
                },
                beforeSend: function(){
                    $('#loadingtrn').show();
                },
                success: function(res) {
                    $('#loadingtrn').hide();
                    console.log(res);
                    /* parsing json */
                    /*{"itm_code":"400001723","itm_desc":"FULLER MAX BOND 300GR","itm_unit":"PCS","cat_code":"40001"}*/
                    var myJSON = res;
                    var myObj = JSON.parse(myJSON);
                    document.getElementById("id_itmcode").value = myObj.itm_code;
                    document.getElementById("id_itmname").value = myObj.itm_desc;
                    $('#id_itmqty').focus();
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
            return false;
        }
    })
</script>


<!-- load modal content -->
<script>
    $("#id_modTgr").click(function(event){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/show_itmlist",
            beforeSend: function(){
                $('#loadingrad').show();
            },
            success: function(res) {
                $('#loadingrad').hide();
                $('#id_mdlBdy').html(res);
                // table configuration
                $('#id_tblItm').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "asc" ]],
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                <!-- get modal table collection -->
                $(document).on('click', '#id_tblItm tr', function(){
                    var Ridx = $(this).index() + 1;
                    console.log("baris ke" + Ridx);
                    var theTbl = document.getElementById('id_tblItm');
                    var txtitmcode = document.getElementById('id_itmcode');
                    txtitmcode.value = theTbl.rows[Ridx].cells[0].innerHTML;
                    var txtitmname = document.getElementById('id_itmname');
                    txtitmname.value = theTbl.rows[Ridx].cells[1].innerHTML;
                    // destroy modal
                    $('#notificationPreview').modal('hide')
                    // enable button save
                    $('#id_btnSave').removeClass('disabled');
                    // set focus ketiga
                    $('#id_itmqty').focus();
                });
            },
            error: function(xhr){
                $('#id_mdlBdy').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText);
            }
        });
    })
</script>



<!-- save data -->
<script>
    $("#id_btnSave").click(function(event) {
        event.preventDefault();
        // get value bill header
		var txt_tmpText = $('#id_tmpText').val();
        var txt_trndate = $('#id_trndate').val();
        var txt_trnnum  = $('#id_trncode').val();
        var txt_trnref  = $('#id_trnref').val();
        // get value bill detail
		var txt_trnseq = $('#id_trnseq').val();
		var txt_itmcode = $('#id_itmcode').val();
		var txt_itmname = $('#id_itmname').val();
		var txt_itmqty  = $('#id_itmqty').val();
		// alert(txt_itmcode + txt_itmname + txt_itmqty + " - " + txt_trnseq);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/create_trans",
            data: {
				txt_tmpText : txt_tmpText,
            	txt_trndate : txt_trndate,
				txt_trnnum  : txt_trnnum,
				txt_trnref  : txt_trnref,
				txt_trnseq  : txt_trnseq,
				txt_itmcode : txt_itmcode,
				txt_itmname : txt_itmname,
				txt_itmqty  : txt_itmqty
            },
            beforeSend: function(){
                $('#loadingtrn').show();
            },
            success: function(res) {
                $('#loadingtrn').hide();
				$('#id_tblTrnDiv').html(res);
                // table configuration list transaksi
                $('#id_tblTrn').DataTable({
                    "retrieve": true, // <-- mencegah error reinitilise table.
                    "order": [[ 0, "desc" ]],
                    "paging": false,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                resetdetail(); // reset form
                $('#id_itmcode').focus();
                $('#id_btnSave').addClass('disabled'); // disable button save
                GetTtlQty();
                GetTtlItem();
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
        return false;
    });
</script>


<!--ketika tombol edit ditekan-->
<script>
	function edituser($trn_seq){
		//alert("kamu tekan baris ke : " + $trn_seq);
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/show_1trans",
			data: {
				trn_seq : $trn_seq
			},
			beforeSend: function(){
				$('#loadingtrn').show();
			},
			success: function(res) {
				$('#loadingtrn').hide();
				console.log(res);
				/*{
				 "trn_seq":"22",
				 "trn_date":"2017-01-02",
				 "trn_code":"0020\/BIL\/I\/2017",
				 "trn_ref":"fsa",
				 "itm_code":"I002",
				 "itm_desc":"ljkjlkioiuoiu",
				 "itm_qty":"23.00"
				 }*/
				/* parsing json */
				var myJSON = res;
				var myObj = JSON.parse(myJSON);
				document.getElementById("id_trnseq").value = myObj.trn_seq;
				document.getElementById("id_trndate").value = myObj.trn_date;
				document.getElementById("id_trncode").value = myObj.trn_code;
				document.getElementById("id_trnref").value = myObj.trn_ref;
				document.getElementById("id_itmcode").value = myObj.itm_code;
				document.getElementById("id_itmname").value = myObj.itm_desc;
				document.getElementById("id_itmqty").value = myObj.itm_qty;
                $('#id_btnSave').removeClass('disabled');
			},
			error: function(xhr){
				alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
			}
		});
		return false;
	}
</script>


<!-- ketika tombol delete ditekan -->
<script>
	function deluser($trn_seq){
		var txt_tmpText = $('#id_tmpText').val();
		// alert("kamu delete baris ke : " + $trn_seq + " hidden date: " + txt_tmpText);
		var answer = confirm ("Hapus data dengan ID: " + $trn_seq + "?");
		if (answer) {
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/del_1trans",
				data: {
					trn_seq : $trn_seq,
					txt_tmpText : txt_tmpText
				},
				beforeSend: function(){
					$('#loadingtrn').show();
				},
				success: function(res) {
					$('#loadingtrn').hide();
					$('#id_tblTrnDiv').html(res);
                    // table configuration list transaksi
                    $('#id_tblTrn').DataTable({
                        "retrieve": true, // <-- mencegah error reinitilise table.
                        "order": [[ 0, "desc" ]],
                        "paging": false,
                        "lengthChange": true,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true
                    });
                    resetdetail();
                    $('#id_btnSave').addClass('disabled');
                    // reset header if row is empty
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/show_numtrans",
                        data: {
                            txt_tmpText : txt_tmpText
                        },
                        beforeSend: function(){
                            $('#loadingtrn').show();
                        },
                        success: function(res) {
                            console.log(res);
                            $('#loadingtrn').hide();
                            if(res == 0){
                                resethead();
                            }
                        },
                        error: function(xhr){
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    });
                    GetTtlQty();
                    GetTtlItem();
				},
				error: function(xhr){
					alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
				}
			});
			return false;
		}
	}
</script>


<!-- import dari excel -->
<script>
    // PROSES IMPORT
    function uploadCsv(){
        event.preventDefault();
        var quest = confirm("This may take a long time, continue?");
        if(quest){
            $('#id_staMes').css('display','').html(""); // hapus css display: none karena efek fadeout() stlh ajax post
            var formData = new FormData($('#id_uploadCsv')[0]); // kenali form, agar element "file" dikenali oleh controler CI.
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/proc_imp/trans",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                },
                success: function(res) {
                    document.getElementById('id_uploadCsv').reset();
                    // tampilkan hasil import dalam modal
                    $('#id_LnImpDet').click(function(){
                        var numofrowins = $(this).text();
                        $('#notificationPreview').modal("show");
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/ShowImpRes",
                            data: {
                                numofrowins : numofrowins
                            },
                            beforeSend: function(){
                                $('#loadingrad').show();
                            },
                            success: function(res) {
                                $('#loadingrad').hide();
                                $('#id_mdlBdy').html(res);
                                // table configuration list transaksi
                                $('#id_tblAftImp').DataTable({
                                    "retrieve": true, // <-- mencegah error reinitilise table.
                                    "order": [[ 0, "asc" ]],
                                    "paging": true,
                                    "lengthChange": true,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true
                                });
                                // tombol delete aft import ditekan
                                $('#id_btnDelImp').click(function(){
                                    var confdel = confirm("Hapus semua hasil import ini?");
                                    if(confdel){
                                        var table       = $('#id_tblAftImp').DataTable();
                                        var serialIdSeq = table.$('.col_idseq, input').serialize();
                                        jQuery.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/DelImpData",
                                            data: serialIdSeq,
                                            beforeSend: function(){
                                                $('#loadingrad').show();
                                            },
                                            success: function(res) {
                                                $('#loadingrad').hide();
                                                $('#id_mdlBdy').html("").html("<div align='center' style='font-size: x-large;'><span class='glyphicon glyphicon-trash'></span> Data hasil import telah dihapus!</div>");
                                            }
                                        });
                                    }
                                });
                            },
                            error: function(xhr){
                                $('#id_mdlBdy').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                            }
                        });
                    })
                },
                error: function(xhr){
                    $().pusherrlog({
                        errtext : 'id_staMes',
                        cicontr : 'adderrlog',
                        errmodl : 'upl csv trans',
                        spinner : 'loadingimp',
                        xhrsttx : xhr.statusText,
                        xhrstat : xhr.status,
                        xhrrspn : xhr.responseText
                    });
                },
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function (e) {
                        var progressval = e.currentTarget.response;
                        $("#progress").html(progressval);
                    });
                    return xhr;
                }
            });
        } else {
            return false;
        }
    }

    function GetTtlQty(){
        var txt_trndate = $('#id_trndate').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/ShowTtlQty",
            data: {
                txt_trndate : txt_trndate
            },
            beforeSend: function(){
            },
            success: function(res) {
                $('#id_TtlQty').html(res);
            },
            error: function(xhr){
                $('#id_TtlQty').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }

    function GetTtlItem(){
        var txt_trndate = $('#id_trndate').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/pages/c_crud_trans/ShowTtlItm",
            data: {
                txt_trndate : txt_trndate
            },
            beforeSend: function(){
            },
            success: function(res) {
                $('#id_TtlItm').html(res);
            },
            error: function(xhr){
                $('#id_TtlItm').html('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
</script>