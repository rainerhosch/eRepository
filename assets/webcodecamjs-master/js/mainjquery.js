/*!
 * WebCodeCamJQuery 2.1.0 javascript Bar-Qr code decoder 
 * Author: Tóth András
 * Web: http://atandrastoth.co.uk
 * email: atandrastoth@gmail.com
 * Licensed under the MIT license
 */
(function(undefined) {
    var scannerLaser = $(".scanner-laser"),
        imageUrl = $("#image-url"),
        decodeLocal = $("#decode-img"),
        play = $("#play"),
        scannedImg = $("#scanned-img"),
        scannedQR = $("#scanned-QR"),
        grabImg = $("#grab-img"),
        pause = $("#pause"),
        stop = $("#stop"),
        contrast = $("#contrast"),
        contrastValue = $("#contrast-value"),
        zoom = $("#zoom"),
        zoomValue = $("#zoom-value"),
        brightness = $("#brightness"),
        brightnessValue = $("#brightness-value"),
        threshold = $("#threshold"),
        thresholdValue = $("#threshold-value"),
        sharpness = $("#sharpness"),
        sharpnessValue = $("#sharpness-value"),
        grayscale = $("#grayscale"),
        grayscaleValue = $("#grayscale-value"),
        flipVertical = $("#flipVertical"),
        flipVerticalValue = $("#flipVertical-value"),
        flipHorizontal = $("#flipHorizontal"),
        flipHorizontalValue = $("#flipHorizontal-value");
    var args = {
        autoBrightnessValue: 100,
        resultFunction: function(res) {
            [].forEach.call(scannerLaser, function(el) {
                $(el).fadeOut(300, function() {
                    $(el).fadeIn(300);
                });
            });
            
            var error               = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/hubungi_admin.mp3');
            var insert              = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/insert_m.mp3');
            var wellcome            = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/wellcome.mp3');
            var update              = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/update.mp3');
            var belum_pulang        = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/belum_pulang.mp3');
            var beres               = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/beres.mp3');
            var data_kosong         = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/data_kosong.mp3');
            var data_telat_checkout = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/data_telat_checkout.mp3');
            var akhir_pekan         = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/akhir_pekan.mp3');
            var bayu                = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/bayu.mp3');
            var bu_mey              = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/bu_mey.mp3');
            var wulan               = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/wulan.mp3');
            var wulan_masuk         = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/wulan_masuk.mp3');
            var masuk_bayu          = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/bayu_masuk.mp3');
            var pak_irsan_pulang    = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/pak_irsan_pulang.mp3');
            var bu_neneng           = new Audio('https://absensi.wastu.digital/assets/webcodecamjs-master/audio/bu_neneng.mp3');
            
           
            
            var xhr = new XMLHttpRequest();
        	xhr.onreadystatechange = function() {
        		if(xhr.readyState == 4 && xhr.status == 200) {
        	        scannedImg.attr("src", res.imgData);
        	        const obj = JSON.parse(xhr.response);
        	        let Ehtml = ``;
        	        Ehtml += `<strong><table width="100%">`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td width="30%">NIDN/NIK</td>`;
                	        Ehtml += `<td width="70%">: `+ obj.nidn_nik +`</td>`;
            	        Ehtml += `</tr>`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>NAMA</td>`;
                	        Ehtml += `<td>: `+ obj.nama +`</td>`;
            	        Ehtml += `</tr>`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>JABATAN</td>`;
                	        Ehtml += `<td>: `+ obj.jabatan +`</td>`;
            	        Ehtml += `</tr>`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>DIVISI</td>`;
                	        Ehtml += `<td>: `+ obj.divisi +`</td>`;
            	        Ehtml += `</tr>`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>WAKTU MASUK</td>`;
                	        Ehtml += `<td>: `+ obj.awal +`</td>`;
            	        Ehtml += `</tr>`;
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>WAKTU PULANG</td>`;
                	        Ehtml += `<td>: `+ obj.akhir +`</td>`;
            	        Ehtml += `</tr>`;
            	        
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>JUMLAH WAKTU</td>`;
                	        Ehtml += `<td>: `+ obj.dataJam +`</td>`;
            	        Ehtml += `</tr>`;
            	        
            	        Ehtml += `<tr class="text-left">`;
            	            Ehtml += `<td>STATUS</td>`;
                	        Ehtml += `<td>: `+ obj.notif +`</td>`;
            	        Ehtml += `</tr>`;
        	        Ehtml += `</table></strong>`;
        	        
                    // notif
                    // nidn_nik
                    // nama
                    // data_waktu
                    // status
                    // res.format
                    
                    scannedQR.html(Ehtml);
                    // console.log(obj);
                    
                    if(obj.status == 0){
                        error.play();
                    } else if(obj.status == 1){
                        if(obj.nidn_nik == '20091054'){
                            wellcome.play();
                        }else if(obj.nidn_nik == '20101055'){
                            masuk_bayu.play();
                        } else if(obj.nidn_nik == '19121050'){
                            bu_neneng.play();
                        } else if(obj.nidn_nik == '19041047'){
                            wulan_masuk.play();
                        } else {
                            insert.play();
                        }
                        
                    } else if(obj.status == 2){
                        // update.play();
                        if(obj.nidn_nik == '20101055'){
                            bayu.play();
                        } else if(obj.nidn_nik == '19041047'){
                            wulan.play();
                        } else if(obj.nidn_nik == '0416129004'){
                            bu_mey.play();
                        } else if(obj.nidn_nik == '0405019001'){
                            pak_irsan_pulang.play();
                        } else {
                            update.play();
                        }
                        
                    } else if(obj.status == 3){
                        belum_pulang.play();
                    } else if(obj.status == 4){
                        // if(obj.nidn_nik == '20101055'){
                        //     akhir_pekan.play();
                        // }else{
                            beres.play();
                        // }
                    } else if(obj.status == 5){
                        data_kosong.play();
                    } else if(obj.status == 6){
                        data_telat_checkout.play();
                    }
        		}
        	}
        	xhr.open("POST", "https://absensi.wastu.digital/tu_admin/Presensi/AbsenDosenAjax_v2?nidn="+res.code);
        	xhr.send();
        	
        },
        getDevicesError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        getUserMediaError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            for (p in error) {
                message += (p + ": " + error[p] + "\n");
            }
            alert(message);
        },
        cameraError: function(error) {
            var p, message = "Error detected with the following parameters:\n";
            if (error.name == "NotSupportedError") {
                var ans = confirm("Your browser does not support getUserMedia via HTTP!\n(see: https://goo.gl/Y0ZkNV).\n You want to see github demo page in a new window?");
                if (ans) {
                    window.open("https://andrastoth.github.io/webcodecamjs/");
                }
            } else {
                for (p in error) {
                    message += p + ": " + error[p] + "\n";
                }
                alert(message);
            }
        },
        cameraSuccess: function() {
            grabImg.removeClass("disabled");
        }
    };
    var decoder = $("#webcodecam-canvas").WebCodeCamJQuery(args).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("#camera-select", "environment|back").init();
    decodeLocal.on("click", function() {
        Page.decodeLocalImage();
    });
    play.on("click", function() {
        scannedQR.text("Scanning ...");
        grabImg.removeClass("disabled");
        decoder.play();
    });
    grabImg.on("click", function() {
        scannedImg.attr("src", decoder.getLastImageSrc());
    });
    pause.on("click", function(event) {
        scannedQR.text("Paused");
        decoder.pause();
    });
    stop.on("click", function(event) {
        grabImg.addClass("disabled");
        scannedQR.text("Stopped");
        decoder.stop();
    });
    Page.changeZoom = function(a) {
        if (decoder.isInitialized()) {
            var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.val() / 10;
            zoomValue.text(zoomValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.zoom = value;
            if (typeof a != "undefined") {
                zoom.val(a * 10);
            }
        }
    };
    Page.changeContrast = function() {
        if (decoder.isInitialized()) {
            var value = contrast.val();
            contrastValue.text(contrastValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.contrast = parseFloat(value);
        }
    };
    Page.changeBrightness = function() {
        if (decoder.isInitialized()) {
            var value = brightness.val();
            brightnessValue.text(brightnessValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.brightness = parseFloat(value);
        }
    };
    Page.changeThreshold = function() {
        if (decoder.isInitialized()) {
            var value = threshold.val();
            thresholdValue.text(thresholdValue.text().split(":")[0] + ": " + value.toString());
            decoder.options.threshold = parseFloat(value);
        }
    };
    Page.changeSharpness = function() {
        if (decoder.isInitialized()) {
            var value = sharpness.prop("checked");
            if (value) {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": on");
                decoder.options.sharpness = [0, -1, 0, -1, 5, -1, 0, -1, 0];
            } else {
                sharpnessValue.text(sharpnessValue.text().split(":")[0] + ": off");
                decoder.options.sharpness = [];
            }
        }
    };
    Page.changeGrayscale = function() {
        if (decoder.isInitialized()) {
            var value = grayscale.prop("checked");
            if (value) {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": on");
                decoder.options.grayScale = true;
            } else {
                grayscaleValue.text(grayscaleValue.text().split(":")[0] + ": off");
                decoder.options.grayScale = false;
            }
        }
    };
    Page.changeVertical = function() {
        if (decoder.isInitialized()) {
            var value = flipVertical.prop("checked");
            if (value) {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": on");
                decoder.options.flipVertical = value;
            } else {
                flipVerticalValue.text(flipVerticalValue.text().split(":")[0] + ": off");
                decoder.options.flipVertical = value;
            }
        }
    };
    Page.changeHorizontal = function() {
        if (decoder.isInitialized()) {
            var value = flipHorizontal.prop("checked");
            if (value) {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": on");
                decoder.options.flipHorizontal = value;
            } else {
                flipHorizontalValue.text(flipHorizontalValue.text().split(":")[0] + ": off");
                decoder.options.flipHorizontal = value;
            }
        }
    };
    Page.decodeLocalImage = function() {
        if (decoder.isInitialized()) {
            decoder.decodeLocalImage(imageUrl.val());
        }
        imageUrl.val(null);
    };
    var getZomm = setInterval(function() {
        var a;
        try {
            a = decoder.getOptimalZoom();
        } catch (e) {
            a = 0;
        }
        if (!!a && a !== 0) {
            Page.changeZoom(a);
            clearInterval(getZomm);
        }
    }, 500);
    $("#camera-select").on("change", function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});