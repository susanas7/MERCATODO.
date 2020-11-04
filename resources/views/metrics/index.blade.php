@extends('layouts.app')

@section('content')
<!--<script type="text/javascript">
  var data = <?php echo json_encode($d); ?>;
  console.log(data);
</script>-->
<metric-component>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="myChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</metric-component>

<script>
data = <?php echo $d; ?>;

myObj = { "name":"John", "age":30, "car":null };
x = myObj.name;
console.log(data)

</script>

@endsection