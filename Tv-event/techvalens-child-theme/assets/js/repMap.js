	var Josh={
			repName:'Josh Hoffman',
			repDesignation:'Regional Plant Specialist',
			repEmail:'josh@rxgreentechnologies.com',
			repContactNumber:'970.205.9901',
			coveredStates : ["WA","OR","CA","AK","HI"]
		};

	var Chip={
			repName:'Chip Provost',
			repDesignation:'Regional Plant Specialist',
			repEmail:'chip@rxgreentechnologies.com',
			repContactNumber:'603.413.8771',
			coveredStates : ["CO","NV","MT","ME","NH","VT","NY","MA","CT","RI","NJ","MD","PA","WV","OH","MI","MN","VA","KY","IL","TN","MS","AR","LA","AZ","NM","OK","TX","BC","AB","SK","MB","ON","QC","NB","NS","NF","PE"]
		};
	
	var tplurl = "/wp-content/themes/pro-child/images/teams/";
	
	jQuery(document).ready(function(){
		
		jQuery('body').on('click','.us_states_act',function(e){

			var pos = jQuery(this).position();
			//jQuery('#rep_info').css('top',pos.top-jQuery('#rep_info').height()-50);
	  		//jQuery('#rep_info').css('left',pos.left-(jQuery('#rep_info').width())/2+30);
	  		jQuery('#rep_info').css('top',e.pageY-jQuery('#rep_info').height()-80);
	  		jQuery('#rep_info').css('left',e.pageX-(jQuery('#rep_info').width())/2-25);
			if(jQuery('#rep_info').css('display') == 'none')
			{
				jQuery('#rep_info').css('display','block');
			}else
			{
				jQuery('#rep_info').css('display','none');
			}
		});
		
		jQuery('body').on('click','.us_states_txt',function(e){

			var pos = jQuery('.us_states_act').position();
			jQuery('#rep_info').css('top',e.pageY-jQuery('#rep_info').height()-80);
	  		jQuery('#rep_info').css('left',e.pageX-(jQuery('#rep_info').width())/2-25);
			if(jQuery('#rep_info').css('display') == 'none')
			{
				jQuery('#rep_info').css('display','block');
			}else
			{
				jQuery('#rep_info').css('display','none');
			}
		});

		jQuery('body').on('click','.us_states',function(e){
            
			var pos = jQuery(this).position();
			var eid = jQuery(this).attr('id');
            hideAllRepWindows(eid);

			//jQuery('#rep_info').css('top',pos.top-jQuery('#rep_info').height()-50);
	  		//jQuery('#rep_info').css('left',pos.left-(jQuery('#rep_info').width())/2+30);
	  		jQuery('#rep_info_'+eid).css('top',e.pageY-jQuery('#rep_info_'+eid).height()-80);
	  		jQuery('#rep_info_'+eid).css('left',e.pageX-(jQuery('#rep_info_'+eid).width())/2-25);

			if(jQuery('#rep_info_'+eid).css('display') == 'none')
			{
				jQuery('#rep_info_'+eid).css('display','block');
			}else
			{
				jQuery('#rep_info_'+eid).css('display','none');
			}
		});
		
		jQuery('body').on('click',function(e){
			if(e.target.parentNode.className.baseVal != 'us_states')
		    {
		      	hideAllRepWindows('all');
		    }
		});



		/*jQuery('body').on('hover','.us_states',function(e){
			var eid = jQuery(this).attr('id');
			if(!jQuery(this).hasClass('us_states_act'))
			{
				jQuery('#rep_info_'+eid).css('display','block');
			}
			
		});
		jQuery('body').on('mouseleave','.us_states',function(e){
			var eid = jQuery(this).attr('id');
			if(!jQuery(this).hasClass('us_states_act'))
			{
				jQuery('#rep_info_'+eid).css('display','none');
			}
		});*/

		grsGetReps();
	});



	function hideAllRepWindows(repId){

		jQuery('.rep_info_outer').each(function(index,element) {

			var winId = jQuery(element).attr('id');

			if(jQuery(element).css('display') == 'block' && winId != 'rep_info_'+repId )
			{
				jQuery(element).css('display','none');
			}

		});

	}
	
	function grsGetRepsByZip()
	{
		var rep_zip = document.getElementById('rep_zip').value;
		var reps = [];
		jQuery('.us_states').removeClass('us_states_act');
		jQuery('g#Group-3 text').removeClass('us_states_txt');
		if(rep_zip != '')
		{
			jQuery.getJSON('/wp-content/themes/pro-child/lib/sales_rep.json',function(data){
				
				jQuery.each( data, function( key, val ) {
					if(rep_zip == val.zipcode)
					{
						if(val.rep_name != '')
						{
							reps.push(val);	
						}				    	
					}
				});
				if(reps.length > 0)
				{
					var htm = '';
					for(i=0;i<reps.length;i++)
					{
						htm = '<div class="rep_info_inner">';
						var state_abbr = reps[i].state_abbr.toLowerCase();
						var rep_nm = reps[i].rep_name;
						rep_nm = rep_nm.replace(/\s+/g, '');
						rep_nm = rep_nm.toLowerCase();
						if(!jQuery('#'+state_abbr).hasClass('us_states_act'))
						{
							jQuery('#'+state_abbr).addClass('us_states_act');
							jQuery('#'+reps[i].state_abbr).addClass('us_states_txt');
						}
						htm = htm+'<h2>'+reps[i].rep_name+'</h2>';
						htm = htm+'<p class="text-center"><img class="rep_info_img" src="'+tplurl+rep_nm+'.jpg" /></p>';
						if(reps[i].rep_email != '')
						{
							htm = htm+'<p>'+reps[i].rep_email+'</p>';
						}
						if(reps[i].rep_contact_number_c != '')
						{
							htm = htm+'<p>'+reps[i].rep_contact_number_c+'</p>';
						}
						if(reps[i].rep_contact_number_o != '')
						{
							htm = htm+'<p>'+reps[i].rep_contact_number_o+'</p>';
						}
						htm = htm+'<p>'+reps[i].county_area+'</p>';
						
						htm = htm+'</div>';
					}
					jQuery('#rep_info').html(htm);			
				}				
			});
		}
		return false;
	}
	var allReps = [];
	var repState = [];
	function grsGetReps()
	{
		
		jQuery.getJSON('/wp-content/themes/pro-child/lib/sales_rep.json',function(data){
			jQuery.each(data,function(key,val){
				if(val.rep_name != '')
				{
					var sabbr = val.state_abbr.toLowerCase();
					if(!isInArray(sabbr,repState))
					{
						repState.push(sabbr);	
					}						
				}
			});
			if(repState.length>0)
			{
				var htm='';
				for(i=0;i<repState.length;i++)
				{
					htm='<div id="rep_info_'+repState[i]+'" class="rep_info_outer"><div class="rep_info_outerbox">';
					htm = htm+'<button type="button" class="close" onclick="grsCloseRepInfo(\'rep_info_'+repState[i]+'\')">×</button>';
					var repZipName=[];
					jQuery.each(data,function(key,val){
						
						if(repState[i] == val.state_abbr.toLowerCase())
						{
							if(val.rep_name != '')
							{
								var state_abbr = val.state_abbr;
								if(!isInArray(val.rep_email,repZipName))
								{
									repZipName.push(val.rep_email);									
									var rep_nm = val.rep_name;
									rep_nm = rep_nm.replace(/\s+/g, '');
									rep_nm = rep_nm.toLowerCase();
									htm = htm+'<div class="rep_info_inner">';
									htm = htm+'<h2>'+val.rep_name+'</h2>';
									htm = htm+'<p class="text-center"><img class="rep_info_img" src="'+tplurl+rep_nm+'.jpg" /></p>';
									if(val.rep_email != '')
									{
										htm = htm+'<p>'+val.rep_email+'</p>';
									}
									if(val.rep_contact_number_c != '')
									{
										htm = htm+'<p class="phon_no">'+val.rep_contact_number_c+'</p>';
									}
									if(val.rep_contact_number_o != '')
									{
										htm = htm+'<p class="phon_no">'+val.rep_contact_number_o+'</p>';
									}	
									htm = htm+'<p>'+val.county_area+'</p>';
									htm = htm+'</div>';
									if(isInArray(state_abbr,Chip.coveredStates))
									{
										repZipName.push(Chip.repEmail);
										var rep_nm = Chip.repName;
										rep_nm = rep_nm.replace(/\s+/g, '');
										rep_nm = rep_nm.toLowerCase();
										htm = htm+'<div class="rep_info_inner">';
										htm = htm+'<h2>'+Chip.repName+'</h2>';
										htm = htm+'<p class="text-center"><img class="rep_info_img" src="'+tplurl+rep_nm+'.jpg" /></p>';
										if(Chip.repEmail != '')
										{
											htm = htm+'<p>'+Chip.repEmail+'</p>';
										}
										if(Chip.repContactNumber != '')
										{
											htm = htm+'<p class="phon_no">'+Chip.repContactNumber+'</p>';
										}
										htm = htm+'<p>'+Chip.repDesignation+'</p>';
										htm = htm+'</div>';
									}
									if(isInArray(state_abbr,Josh.coveredStates))
									{
										repZipName.push(val.rep_email);
										var rep_nm = Josh.repName;
										rep_nm = rep_nm.replace(/\s+/g, '');
										rep_nm = rep_nm.toLowerCase();
										htm = htm+'<div class="rep_info_inner">';
										htm = htm+'<h2>'+Josh.repName+'</h2>';
										htm = htm+'<p class="text-center"><img class="rep_info_img" src="'+tplurl+rep_nm+'.jpg" /></p>';
										if(Josh.repEmail != '')
										{
											htm = htm+'<p>'+Josh.repEmail+'</p>';
										}
										if(Josh.repContactNumber != '')
										{
											htm = htm+'<p class="phon_no">'+Josh.repContactNumber+'</p>';
										}
										htm = htm+'<p>'+Josh.repDesignation+'</p>';
										htm = htm+'</div>';
									}
								}													
							}				    	
						}
					});

					htm = htm+'</div></div>';
					allReps.push(htm);
					jQuery('#rep_info').after(htm);
				}
			}
		});
	}

	function isInArray(value, array) {
		return array.indexOf(value) > -1;
	}

	function grsCloseRepInfo(eid)
	{
		jQuery('#'+eid).css('display','none');
	}