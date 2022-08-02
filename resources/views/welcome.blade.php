<div>
<ul class="ull">
@foreach ($getPaymentChannels as $channel)
  <li style="<?php echo ($channel['is_enabled'] == false) ? 'display:none;' : '' ?> ">{{$channel['name']}} / {{$channel['currency']}} / {{$channel['channel_category']}}</li>
@endforeach
</ul>
</div>

<style>

.ull {
  list-style-type: none; /* Remove bullets */
  padding: 0; /* Remove padding */
  margin: 0; /* Remove margins */
}

.ull li {
  border: 1px solid #ddd; /* Add a thin border to each list item */
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6; /* Add a grey background color */
  padding: 12px; /* Add some padding */
}
</style>