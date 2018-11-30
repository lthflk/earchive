$(document).ready(function() {
	var url = $(location).attr("href");
	var segments = url.split("/");

	$("#tanggal").datepicker({
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
	$("#tgl_pinjam").datepicker({
		maxDate: "0",
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
	$("#tgl_haruskembali").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});

	/** Fungsi untuk menghapus data arsip */
	$(".deldata").click(function() {
		var d = $(this).attr("id");
		$("#deliddata").val(d);
	});
	$("#deldatago").on("click", function() {
		$("#fdeldata").submit();
	});
	$("#fdeldata").ajaxForm({ success: deldata });
	function deldata() {
		alert("Data telah sukses dihapus");
		$("#deldata").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk menghapus data sirkulasi arsip */
	$(".sdeldata").click(function() {
		var d = $(this).attr("id");
		$("#deliddata").val(d);
	});
	$("#sdeldatago").on("click", function() {
		$("#fsdeldata").submit();
	});
	$("#fsdeldata").ajaxForm({ success: sdeldata });
	function sdeldata() {
		alert("Data telah sukses dihapus");
		$("#deldata").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk mengembalikan arsip dalam sirkulasi */
	$(".kemdata").click(function() {
		var d = $(this).attr("id");
		$("#kemid").val(d);
	});
	$("#kemarsipgo").on("click", function() {
		$("#fkemarsip").submit();
	});
	$("#fkemarsip").ajaxForm({ success: kembdata });
	function kembdata() {
		alert("Arsip telah sukses dikembalikan");
		$("#arsipkembali").modal("hide");
		window.location.reload(true);
	}

	/** Fungsi untuk menghapus file attachment arsip */
	$("#delfilego").on("click", function() {
		$("#fdelfile").submit();
	});
	$("#fdelfile").ajaxForm({ success: delfile });
	function delfile() {
		alert("File telah sukses dihapus");
		$("#uplodfile").show();
		$("#linkfile").hide();
		$("#delfile").modal("hide");
	}

	/** Fungsi-fungsi terkait dengan data master user aplikasi arsip */
	function reloaduser() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloaduser/",
			cache: false,
			success: function(html) {
				$("#divtabeluser").html(html);
			}
		});
	}
	// if ($("#divtabeluser").length > 0) {
	// 	location.reload();
	// }
	$("#divtabeluser").on("click", ".deluser", function() {
		var d = $(this).attr("id");
		$("#deliduser").val(d);
	});

	$("#delusergo").on("click", function() {
		$("#fdeluser").submit();
	});
	$("#fdeluser").ajaxForm({ success: deluser });
	function deluser() {
		alert("Data telah sukses dihapus");
		location.reload();
		$("#deluser").modal("hide");
	}
	$("#editusergo").on("click", function() {
		$("#feduser").submit();
	});
	$("#feduser").ajaxForm({ success: eduser });
	function eduser() {
		alert("Data telah sukses disimpan");
		location.reload();
		$("#feduser")[0].reset();
		$("#edituser").modal("hide");
	}

	$("#addusergo").on("click", function() {
		var d = $("#username").val();
		if($("#username").val() != "" && $("#password").val()!=""){
			$.ajax({
				type: "POST",
				url: site_url + "/admin/cekuser/",
				data: "username=" + d,
				cache: false,
				success: function(ahtml) {
					html = jQuery.parseJSON(ahtml);
					if (html.msg == "ok") {
						$("#fadduser").submit();
					} else {
						alert("username sudah terpakai!");
					}
				}
			});
		}else{
			alert("username dan password wajib diisi");
		}
	});
	$("#fadduser").ajaxForm({ success: adduser });
	function adduser(responseText, statusText, xhr, $form) {
		var jsonData = JSON.parse(responseText);
		if (jsonData.status == "error" && jsonData.pesan == "PASSWORD_UNMATCH") {
			alert(
				"Password yang anda tuliskan tidak sama dengan konfirmasi password.\nHarap periksa penggunaan huruf besar kecil."
			);
			$("#password, #conf_password").addClass("input-error");
			return false;
		}
		alert("Data telah sukses disimpan");
		location.reload();
		$("#adduser").modal("hide");
		$("#password, #conf_password").removeClass("input-error");
		$("#fadduser")[0].reset();
	}

	// $('.modal-backdrop').remove();
	// $(document.body).removeClass("modal-open");
	// $('.modal.in').modal('hide');

	$("#divtabeluser").on("click", ".eduser", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/auser/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#feduser")[0].reset();
				$("#eusername").val(html.username);
				$("#estatus").val(html.status);
				$("#etipe").val(html.tipe);
				$("#eakses_klas").val(html.akses_klas);
				$("#ediduser").val(html.id);
				$("#edepartemen").val(html.depar);
				if (html.akses_modul != "") {
					var akses_modul = jQuery.parseJSON(html.akses_modul);
					if (typeof akses_modul == "object") {
						if (akses_modul.entridata == "on")
							$("#emodul1").prop("checked", true);
						if (akses_modul.sirkulasi == "on")
							$("#emodul2").prop("checked", true);
						if (akses_modul.klasifikasi == "on")
							$("#emodul3").prop("checked", true);
						if (akses_modul.pencipta == "on")
							$("#emodul4").prop("checked", true);
						if (akses_modul.pengolah == "on")
							$("#emodul5").prop("checked", true);
						if (akses_modul.lokasi == "on") $("#emodul6").prop("checked", true);
						if (akses_modul.media == "on") $("#emodul7").prop("checked", true);
						if (akses_modul.user == "on") $("#emodul8").prop("checked", true);
						if (akses_modul.import == "on") $("#emodul9").prop("checked", true);
						if (akses_modul.backupdb == "on") $("#emodul20").prop("checked", true);
						if (akses_modul.departemen == "on") $("#emodul21").prop("checked", true);
					}
				}
			}
		});
	});
	//////////////////////
	/////////////////////kode
	function reloadkode() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadkode/",
			cache: false,
			success: function(html) {
				$("#divtabelkode").html(html);
			}
		});
	}
	// if ($("#divtabelkode").length > 0) {
	// 	reloadkode();
	// }
	$("#divtabelkode").on("click", ".delkode", function() {
		var d = $(this).attr("id");
		$("#delidkode").val(d);
	});

	$("#delkodego").on("click", function() {
		$("#fdelkode").submit();
	});
	$("#fdelkode").ajaxForm({ success: delkode });
	function delkode() {
		alert("Data telah sukses dihapus");
		location.reload();
		$("#delkode").modal("hide");
	}
	$("#editkodego").on("click", function() {
		$("#fedkode").submit();
	});
	$("#fedkode").ajaxForm({ success: edkode });
	function edkode() {
		alert("Data telah sukses disimpan");
		location.reload();
		$("#editkode").modal("hide");
	}

	$("#addkodego").on("click", function() {
		$("#faddkode").submit();
	});
	$("#faddkode").ajaxForm({ success: addkode });
	function addkode() {
		alert("Data telah sukses disimpan");
		location.reload();
		$("#addkode").modal("hide");
		$("#faddkode")[0].reset();
	}

	$("#divtabelkode").on("click", ".edkode", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/akode/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#ekode").val(html.kode);
				$("#enama").val(html.nama);
				$("#eretensi").val(html.retensi);
				$("#edidkode").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master pencipta arsip */
	function reloadpenc() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadpenc",
			cache: false,
			success: function(html) {
				$("#divtabelpenc").html(html);
			}
		});
	}
	// if ($("#divtabelpenc").length > 0) {
	// 	reloadpenc();
	// }
	$("#divtabelpenc").on("click", ".delpenc", function() {
		var d = $(this).attr("id");
		$("#delidpenc").val(d);
	});
	$("#delpencgo").on("click", function() {
		$("#fdelpenc").submit();
	});
	$("#fdelpenc").ajaxForm({ success: delpenc });
	function delpenc() {
		alert("Data telah sukses dihapus");
		$("#delpenc").modal("hide");
		reloadpenc();
	}

	// AJAX untuk edit data pencipta
	$("#editpencgo").on("click", function() {
		$("#fedpenc").submit();
	});
	$("#fedpenc").ajaxForm({ success: edpenc });
	function edpenc() {
		alert("Data telah sukses disimpan");
		$("#editpenc").modal("hide");
		reloadpenc();
	}

	// AJAX untuk tambah data pencipta
	$("#addpencgo").on("click", function() {
		// alert($('#faddpenc').serialize());
		var form = $("#faddpenc");
		$.post(form.attr("action"), form.serialize()).done(addpenc);
	});
	function addpenc(data) {
		alert("Data telah sukses disimpan");
		$("#addpenc").modal("hide");
		$("#faddpenc")[0].reset();
		reloadpenc();
	}

	$("#divtabelpenc").on("click", ".edpenc", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/apenc/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_pencipta);
				$("#edidpenc").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master unit pengolah arsip */
	function reloadpeng() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadpeng",
			cache: false,
			success: function(html) {
				$("#divtabelpeng").html(html);
			}
		});
	}
	// if ($("#divtabelpeng").length > 0) {
	// 	reloadpeng();
	// }
	$("#divtabelpeng").on("click", ".delpeng", function() {
		var d = $(this).attr("id");
		$("#delidpeng").val(d);
	});
	$("#delpenggo").on("click", function() {
		$("#fdelpeng").submit();
	});
	$("#fdelpeng").ajaxForm({ success: delpeng });
	function delpeng() {
		alert("Data telah sukses dihapus");
		$("#delpeng").modal("hide");
		reloadpeng();
	}
	$("#editpenggo").on("click", function() {
		$("#fedpeng").submit();
	});
	$("#fedpeng").ajaxForm({ success: edpeng });
	function edpeng() {
		alert("Data telah sukses disimpan");
		$("#editpeng").modal("hide");
		reloadpeng();
	}
	$("#addpenggo").on("click", function() {
		$("#faddpeng").submit();
	});
	$("#faddpeng").ajaxForm({ success: addpeng });
	function addpeng() {
		alert("Data telah sukses disimpan");
		$("#addpeng").modal("hide");
		$("#faddpeng")[0].reset();
		reloadpeng();
	}
	$("#divtabelpeng").on("click", ".edpeng", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/apeng/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_pengolah);
				$("#edidpeng").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master lokasi arsip */
	function reloadlok() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadlok",
			cache: false,
			success: function(html) {
				$("#divtabellok").html(html);
			}
		});
	}
	if ($("#divtabellok").length > 0) {
		// location.reload();
		// reloadlok();
	}
	$("#divtabellok").on("click", ".dellok", function() {
		var d = $(this).attr("id");
		$("#delidlok").val(d);
	});
	$("#dellokgo").on("click", function() {
		$("#fdellok").submit();
	});
	$("#fdellok").ajaxForm({ success: dellok });
	function dellok() {
		alert("Data telah sukses dihapus");
		$("#dellok").modal("hide");
		location.reload();
		// reloadlok();
	}
	$("#editlokgo").on("click", function() {
		$("#fedlok").submit();
	});
	$("#fedlok").ajaxForm({ success: edlok });
	function edlok() {
		alert("Data telah sukses disimpan");
		$("#editlok").modal("hide");
		location.reload();
		// reloadlok();
	}
	$("#addlokgo").on("click", function() {
		$("#faddlok").submit();
	});
	$("#faddlok").ajaxForm({ success: addlok });
	function addlok() {
		alert("Data telah sukses disimpan");
		$("#addlok").modal("hide");
		$("#faddlok")[0].reset();
		location.reload();
		// reloadlok();
	}
	$("#divtabellok").on("click", ".edlok", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/alok/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_lokasi);
				$("#edidlok").val(html.id);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master departemen arsip */
	$("#divtabeldept").on("click", ".deldep", function() {
		var d = $(this).attr("id");
		$("#deliddep").val(d);
	});
	$("#deldepgo").on("click", function() {
		$("#fdeldep").submit();
	});
	$("#fdeldep").ajaxForm({ success: deldep });
	function deldep() {
		alert("Data telah sukses dihapus");
		var d = $("#deliddep").val();
		$("#deldep").modal("hide");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/deldep/",
			data: "id=" + d,
			cache: false,
			success: function(res) {
				console.log(res);
			}
		});
		location.reload();
		// reloaddep();
	}
	$("#editdepgo").on("click", function() {
		$("#feddep").submit();
	});
	$("#feddep").ajaxForm({ success: eddep });
	function eddep() {
		/* letak proses ajax */
		var id = $("#id_dep").val();
		var kode = $("#ekode").val();
		var nama = $("#ename").val();
		var keterangan = $("#eketerangan").val();
		$.ajax({
			type: "POST",
			url: site_url + "/admin/eddep/",
			data: {id:id, kode:kode, nama:nama, keterangan:keterangan},
			cache: false,
			success: function(response) {
				console.log(response);
				res = jQuery.parseJSON(response);
				if(res['status']=="success"){
					location.reload();
				}else{
					alert("Terjadi kesalahan sistem");
				}
			},
			failed:function(e){
				console.log(e);
				alert("Gagal!");
			}
		});
		$("#editdep").modal("hide");
	}
	$("#adddepgo").on("click", function() {
		$("#fadddep").submit();
	});
	$("#fadddep").ajaxForm({ success: adddep });
	function adddep() {
		alert("Data telah sukses disimpan");
		$("#adddep").modal("hide");
		$("#fadddep")[0].reseta();
		location.reload();
		// reloaddep();
	}
	$("#divtabeldept").on("click", ".eddep", function() {
		var d = $(this).attr("id");
		var kode_dep = $(this).data("kode_dep");
		var nama_dep = $(this).data("nama_dep");
		var ket = $(this).data("keterangan");
		$("#id_dep").val(d);
		$("#ekode").val(kode_dep);
		$("#ename").val(nama_dep);
		$("#eketerangan").val(ket);

	});

	/** Fungsi-fungsi terkait dengan data master lantai arsip */
	$("#divtabellan").on("click", ".dellan", function() {
		var d = $(this).attr("id");
		$("#delidlan").val(d);
	});
	$("#dellango").on("click", function() {
		$("#fdellan").submit();
	});
	$("#fdellan").ajaxForm({ success: dellan });
	function dellan() {
		alert("Data telah sukses dihapus");
		$("#dellan").modal("hide");
		location.reload();
	}
	$("#editlango").on("click", function() {
		$("#fedlan").submit();
	});
	$("#fedlan").ajaxForm({ success: edlan });
	function edlan() {
		alert("Data telah sukses disimpan");
		$("#editlan").modal("hide");
		location.reload();
	}
	$("#addlango").on("click", function() {
		$("#faddlan").submit();
	});
	$("#faddlan").ajaxForm({ success: addlan });
	function addlan() {
		alert("Data telah sukses disimpan");
		$("#addlan").modal("hide");
		$("#faddlan")[0].reset();
		location.reload();
	}
	$("#divtabellan").on("click", ".edlan", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/alan/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#eno_lantai").val(html.no_lantai);
				$("#edidlan").val(html.id_lantai);
			}
		});
	});

/** Fungsi-fungsi terkait dengan data master ruangan arsip */
	$("#divtabelrua").on("click", ".delrua", function() {
		var d = $(this).attr("id");
		$("#delidrua").val(d);
	});
	$("#delruago").on("click", function() {
		$("#fdelrua").submit();
	});
	$("#fdelrua").ajaxForm({ success: delrua });
	function delrua() {
		alert("Data telah sukses dihapus");
		$("#delrua").modal("hide");
		location.reload();
	}
	$("#editruago").on("click", function() {
		$("#fedrua").submit();
	});
	$("#fedrua").ajaxForm({ success: edrua });
	function edrua() {
		alert("Data telah sukses disimpan");
		$("#editrua").modal("hide");
		location.reload();
	}
	$("#addruago").on("click", function() {
		$("#faddrua").submit();
	});
	$("#faddrua").ajaxForm({ success: addrua });
	function addrua() {
		alert("Data telah sukses disimpan");
		$("#addrua").modal("hide");
		$("#faddrua")[0].reset();
		location.reload();
	}
	$("#divtabelrua").on("click", ".edrua", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/arua/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama_ruangan").val(html.nama_ruangan);
				$("#edidrua").val(html.id_ruangan);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master lemari arsip */
	$("#divtabellem").on("click", ".dellem", function() {
		var d = $(this).attr("id");
		$("#delidlem").val(d);
	});
	$("#dellemgo").on("click", function() {
		$("#fdellem").submit();
	});
	$("#fdellem").ajaxForm({ success: dellem });
	function dellem() {
		alert("Data telah sukses dihapus");
		$("#dellem").modal("hide");
		location.reload();
	}
	$("#editlemgo").on("click", function() {
		$("#fedlem").submit();
	});
	$("#fedlem").ajaxForm({ success: edlem });
	function edlem() {
		alert("Data telah sukses disimpan");
		$("#editlem").modal("hide");
		location.reload();
	}
	$("#addlemgo").on("click", function() {
		$("#faddlem").submit();
	});
	$("#faddlem").ajaxForm({ success: addlem });
	function addlem() {
		alert("Data telah sukses disimpan");
		$("#addlem").modal("hide");
		$("#faddlem")[0].reset();
		location.reload();
	}
	$("#divtabellem").on("click", ".edlem", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/alem/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#eno_lemari").val(html.no_lemari);
				$("#edidlem").val(html.id_lemari);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master baris arsip */
	$("#divtabelbar").on("click", ".delbar", function() {
		var d = $(this).attr("id");
		$("#delidbar").val(d);
	});
	$("#delbargo").on("click", function() {
		$("#fdelbar").submit();
	});
	$("#fdelbar").ajaxForm({ success: delbar });
	function delbar() {
		alert("Data telah sukses dihapus");
		$("#delbar").modal("hide");
		location.reload();
	}
	$("#editbargo").on("click", function() {
		$("#fedbar").submit();
	});
	$("#fedbar").ajaxForm({ success: edbar });
	function edbar() {
		alert("Data telah sukses disimpan");
		$("#editbar").modal("hide");
		location.reload();
	}
	$("#addbargo").on("click", function() {
		$("#faddbar").submit();
	});
	$("#faddbar").ajaxForm({ success: addbar });
	function addbar() {
		alert("Data telah sukses disimpan");
		$("#addbar").modal("hide");
		$("#faddbar")[0].reset();
		location.reload();
	}
	$("#divtabelbar").on("click", ".edbar", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/abar/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#eno_baris").val(html.no_baris);
				$("#edidbar").val(html.id_baris);
			}
		});
	});

	/** Fungsi-fungsi terkait dengan data master media arsip */
	function reloadmed() {
		$.ajax({
			type: "POST",
			url: site_url + "/admin/reloadmed",
			cache: false,
			success: function(html) {
				$("#divtabelmed").html(html);
			}
		});
	}
	// if ($("#divtabelmed").length > 0) {
	// 	reloadmed();
	// }
	$("#divtabelmed").on("click", ".delmed", function() {
		var d = $(this).attr("id");
		$("#delidmed").val(d);
	});
	$("#delmedgo").on("click", function() {
		$("#fdelmed").submit();
	});
	$("#fdelmed").ajaxForm({ success: delmed });
	function delmed() {
		alert("Data telah sukses dihapus");
		$("#delmed").modal("hide");
		reloadmed();
	}
	$("#editmedgo").on("click", function() {
		$("#fedmed").submit();
	});
	$("#fedmed").ajaxForm({ success: edmed });
	function edmed() {
		alert("Data telah sukses disimpan");
		$("#editmed").modal("hide");
		reloadmed();
	}
	$("#addmedgo").on("click", function() {
		$("#faddmed").submit();
	});
	$("#faddmed").ajaxForm({ success: addmed });
	function addmed() {
		alert("Data telah sukses disimpan");
		$("#addmed").modal("hide");
		$("#faddmed")[0].reset();
		reloadmed();
	}
	$("#divtabelmed").on("click", ".edmed", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: site_url + "/admin/amed/",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#enama").val(html.nama_media);
				$("#edidmed").val(html.id);
			}
		});
	});

/** Init plugins dropdown chosen */
	$(".chosen").chosen();

	function formatnumber(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	$(".trigger-submit").on("click", function(e) {
		$("#singlebutton").trigger("click");
	});

	var xhr;
	$("input.xhr").each(function() {
		var obj = $(this);
		obj.autoComplete({
			minChars: 3,
			source: function(term, response) {
				// try { xhr.abort(); } catch(e){}
				xhr = $.getJSON(
					obj.attr("data-xhr") + "/" + term,
					{ q: term },
					function(data) {
						response(data);
					}
				);
			},
			renderItem: function(item, search) {
				// convert ke array
				var arr = Object.keys(item).map(function(k) {
					return item[k];
				});
				return (
					'<div class="autocomplete-suggestion" data-val="' +
					arr[0] +
					'">' +
					arr[0] +
					"</div>"
				);
			}
		});
	});
});

    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else
     if (e) {
         key = e.which;
     } else return true;
   
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }

        /** JS untuk form entri lokasi arsip **/

    $('#lokasi_arsip').change(function(){
        var url = window.location.href;
        var split = url.split("index.php");
        var host_CI = split[0]; // http://127.0.0.1/DA/
        var alamat_controller = "/admin/get_lantai";
        var url_tujuan = host_CI+"index.php"+alamat_controller;
        console.log(url_tujuan);
                    $.getJSON(url_tujuan,
                        {id_lokasi:$(this).val()}, 
                        function(json){
                        $("#lantai_arsip").removeAttr("disabled");
                        $('#lantai_arsip').html('');
                        $('#lantai_arsip').append('<option value="">Pilih Lantai</option>');
                        $.each(json, function(index, row) {
                            $('#lantai_arsip').append('<option value='+row.id_lantai+'>'+row.no_lantai+'</option>');
                        });
                    });
                });
    $('#lantai_arsip').change(function(){
        var url = window.location.href;
        var split = url.split("index.php");
        var host_CI = split[0]; // http://127.0.0.1/DA/
        var alamat_controller = "/admin/get_ruangan";
        var url_tujuan = host_CI+"index.php"+alamat_controller;
        console.log(url_tujuan);
                    $.getJSON(url_tujuan,
                        {id_lantai:$(this).val()}, 
                        function(json){
                        $("#ruangan_arsip").removeAttr("disabled");
                        $('#ruangan_arsip').html('');
                        $('#ruangan_arsip').append('<option value="">Pilih Ruangan</option>');
                        $.each(json, function(index, row) {
                            $('#ruangan_arsip').append('<option value='+row.id_ruangan+'>'+row.nama_ruangan+'</option>');
                        });
                    });
                });
    $('#ruangan_arsip').change(function(){
        var url = window.location.href;
        var split = url.split("index.php");
        var host_CI = split[0]; // http://127.0.0.1/DA/
        var alamat_controller = "/admin/get_lemari";
        var url_tujuan = host_CI+"index.php"+alamat_controller;
        console.log(url_tujuan);
                    $.getJSON(url_tujuan,
                        {id_ruangan:$(this).val()}, 
                        function(json){
                        $("#lemari_arsip").removeAttr("disabled");
                        $('#lemari_arsip').html('');
                        $('#lemari_arsip').append('<option value="">Pilih Lemari</option>');
                        $.each(json, function(index, row) {
                            $('#lemari_arsip').append('<option value='+row.id_lemari+'>'+row.no_lemari+'</option>');
                        });
                    });
                });
    $('#lemari_arsip').change(function(){
        var url = window.location.href;
        var split = url.split("index.php");
        var host_CI = split[0]; // http://127.0.0.1/DA/
        var alamat_controller = "/admin/get_baris";
        var url_tujuan = host_CI+"index.php"+alamat_controller;
        console.log(url_tujuan);
                    $.getJSON(url_tujuan,
                        {id_lemari:$(this).val()}, 
                        function(json){
                        $("#baris_arsip").removeAttr("disabled");
                        $('#baris_arsip').html('');
                        $('#baris_arsip').append('<option value="">Pilih Baris</option>');
                        $.each(json, function(index, row) {
                            $('#baris_arsip').append('<option value='+row.id_baris+'>'+row.no_baris+'</option>');
                        });
                    });
                });
