
<?php 
include("db_connector/mysqli_conn.php");
?>

 <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <script type="text/javascript" src="js/jquery.countTo.js"></script>
 
 <script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/exporting.js"></script>

  <script type="text/javascript">
    jQuery(function ($) {
      // custom formatting example
      $('#earth').data('countToOptions', {
        formatter: function (value, options) {
          return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
      });

      // custom callback when counting completes
      $('#countdown').data('countToOptions', {
        onComplete: function (value) {
          $(this).text('BLAST OFF!').addClass('red');
        }
      });

      // another custom callback for counting to infinity
      $('#infinity').data('countToOptions', {
        onComplete: function (value) {
          count.call(this, {
            from: value,
            to: value + 1000
          });
        }
      });

      // start all the timers
      $('.timer').each(count);

      // restart a timer when a button is clicked
      $('.restart').click(function (event) {
        event.preventDefault();
        var target = $(this).data('target');
        $(target).countTo('restart');
      });

      function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
      }
    });
  </script>
<div class="col-md-12" style=" background:white; border-radius: 5px;">
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  <li class=""><a href="dashboard.php?action=start_activity">Quick Start New field Activity</a></li>
				  <li class=""><a href="dashboard.php?action=manage_field_activities">Field Activities List</a></li>  
                 </ul>
		  </div>                              
               <div class="box-header with-border">
                 <h5 class="box-title"><strong>MEMPROW Information System</strong></h5>
                </div>
				      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><b class="timer" id="" data-from="0" data-to="<?php $sql=mysqli_query($dbcon, "select count(objective) from objectives"); 
			     $row=mysqli_fetch_array($sql);
				 echo $row[0];?>" data-speed="900" data-decimals="0"></b>
			  </h3>

              <p>Objectives</p>
            </div>
            <div class="icon">
              <i class="ion-ios-photos"></i>
            </div>
            <a href="?action=manage_objectives" class="small-box-footer">Details<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><b class="timer" id="" data-from="0" data-to="<?php $sql=mysqli_query($dbcon, "select count(activity) from activities"); 
			     $row=mysqli_fetch_array($sql);
				 echo $row[0];?>" data-speed="900" data-decimals="0"></b>
			  <sup style="font-size: 20px"></sup></h3>

              <p>Standard / Base Activities</p>
            </div>
            <div class="icon">
              <i class="ion-document-text"></i>
            </div>
            <a href="?action=manage_activities" class="small-box-footer">Details<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><b class="timer" id="" data-from="0" data-to="<?php $sql=mysqli_query($dbcon, "select count(training) from field_work"); 
			     $row=mysqli_fetch_array($sql);
				 echo $row[0]; ?>" data-speed="3000" data-decimals="0"></b>
			  
			  </h3>
                        
              <p>Field Work Activities</p>
            </div>
            <div class="icon">
              <i class="ion-filing"></i>
            </div>
            <a href="?action=manage_field_activities" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><b class="timer" id="" data-from="0" data-to="<?php $sql=mysqli_query($dbcon, "select count(Distinct(participant_id)) from field_participants"); 
			     $row=mysqli_fetch_array($sql);
				 echo $row[0];
			  ?>" data-speed="3000" data-decimals="0"></b></h3>

              <p>Participants/ Trainees</p>
            </div>
            <div class="icon">
              <i class="ion-android-people"></i>
            </div>
            <a href="?action=view_participants" class="small-box-footer">Details<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
        <!-- ./col -->
      </div>
            <div class="col-md-12" id="chart" style="min-width:95%; max-width:98%; height:400px;">
			
			
			
        	</div>	
			
</div>



    <script type="text/javascript">
$(function () {
	
	 $.ajax({
        url: 'modules/chart_data.php',
        type: "GET",
        dataType: "json",
        data : {dat : "dt"},
        success: function(data) {
            
         
	var Month1=parseInt(data.month1);
	var Month2=parseInt(data.month2);
	var Month3=parseInt(data.month3);
	var Month4=parseInt(data.month4);
	var months=(data.months);
	console.log(data);
	

    $('#chart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'NUMBER ACTIVITIES PERFORMED IN THE LAST FOUR MONTHS'
        },
        xAxis: {
		categories:[months[3],months[2], months[1],months[0]]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Activities'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series:[
        {
        name:'Activities',
        color:'#0071de',
        data:[Month4,Month3,Month2,Month1]
  
        }]
    });
	
	
	  
        },//end success ftn
        cache: false
    }); //end ajax
	
});//end doc ready

</script>


<script>
                                        
//Absorbed 
//Left
//Not absorbed
//Not eligible for absorption
//Not yet submitted for absorption
//Position not advertised/no vacancy
//Submitted for absorption
    /*


function requestData() {
    $.ajax({
        url: 'modules/chart_data.php',
        type: "GET",
        dataType: "json",
        data : {dat : "dt"},
        success: function(data) {
            /*chart.addSeries({
              name: "Quarter",
              data: data.quarter1
			  alert(data);
            });
        },
        cache: false
    });*/

</script>
