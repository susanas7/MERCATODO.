@extends('layouts.app')

@section('content')
<!--<script type="text/javascript">
  var data = <?php echo json_encode($d); ?>;
  console.log(data);
</script>-->
<metric-component d="{{$d}}">
            <div class="columns">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="myChart" height="50" width="50"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form1">{{$d}}</div>
</metric-component>


<script type="text/javascript">
var d = "<?php echo $d; ?>" ;
var id = "<?php echo $id; ?>" ;
console.log(id);
console.log(d);
</script>


@endsection