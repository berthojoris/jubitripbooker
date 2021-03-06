<?=render('includes.header'); ?>
<?=render('includes.navbar'); ?>
<div class="container">
<div class="content" id="content" style="display:none">
  <div class="page-header">
    <h2>Your booked Trips</h2>
  </div>
  <div class="row">
  <div class="span10 offset1">
    <table class="table table-bordered">
    <thead>
      <tr style="background-color: #D9EDF7;">
        <th>Day</th>
        <th>Place</th>
        <th>Trip</th>
        <th>Cost</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <? foreach ($bookings as $booking): ?>
    <tr>
      <td><?=$booking->day; ?></td>
      <td><?=$booking->name; ?></td>
      <td><?=$booking->title; ?></td>
      <td><?=$booking->cost; ?>€</td>
      <td class="td-center">
      <form class="cancelTrip" style="margin-bottom: 0;">
        <input type="hidden" name="bookingID" value="<?=$booking->id; ?>">
        <button class="btn btn-small btn-danger" type="submit">Cancel</button>
      </form>
      </td>
    </tr>
    <? endforeach; ?>
    </tbody>
  </table>
  </div>
  </div>
  <div id="status" class="row status-box">
    <div class="span6 offset3">
      <div id="success" class="alert alert-success hide">The booking has been canceled!</div>
      <div id="error" class="alert alert-error hide">Error</div>
    </div>
  </div>
</div>
<?=render('includes.footer'); ?>
</div>
<?=HTML::script('js/jquery.js'); ?>
<script>
$(document).ready(function() {

  $('.cancelTrip').submit(function(){
    
    var form = $(this);
    var button = form.children('button');
    button.prop('disabled', true);

    $('#success').hide();
    $('#error').hide();
    
    var faction = "<?=URL::to('user/cancel'); ?>";
    var fdata = form.serialize();

    $.post(faction, fdata, function(json) {
      
      if (json.success) {
          $('#success').show();
      } else {
          $('#error').show();
      }     
    });
      
    return false;
  });

  $('#nav-booked').addClass('active');

  $('#content').fadeIn(1000);
});
</script>
</body>
</html>
