<!DOCTYPE html>
<style>
    .mail-order-successful-header h2{
        justify-self: center;
        padding: 2% 2% 2% 2%;
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background-color: #CDCDCD;
        border-radius: 20px;
    }
    .mail-order-successful-content{
        display: grid;
        grid-template: repeat(2, 1fr) / repeat(3, 1fr);
        grid-template-areas: "title"
                             "details";
        background-color: #CDCDCD;
        border-radius: 20px;
    }
    .mail-order-successful-title{
        grid-area: title;
        grid-row: 1 / span 1;
        grid-column: 1 / span 2;
        padding: 4% 4% 4% 4%;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background-color: #CDCDCD;
        border-radius: 20px;
    }

    .mail-order-successful-details{
        grid-area: details;
        grid-row: 2 / span 1;
        grid-column: 2 / span 2;
        padding: 4% 4% 4% 4%;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background-color: #CDCDCD;
        border-radius: 20px;
    }
</style>
<body>
    <main>
        <section class="mail-order-successful-header">
            <h2>Orden recibida</h2>
        </section>
        <section class="mail-order-successful-content">
            <div class="mail-order-successful-title">
                <h4>¡Gracias por su compra!</h4>
                <h5>Su orden ha sido recibida, y pronto será procesada.</h5>
            </div>
            <div class="mail-order-successful-details">
                <h5>Referencia: {{$order->id}}</h5>
                <h5>Comprador: {{$order->user->name ?? ''}} </h5>
                <h5>Estado: {{$order->status}} </h5>
                @foreach($order->products as $product)
                <h5>{{$product->title}}</h5>
                 @endforeach
                <h5>Total: {{$order->total}} </h5>
            </div>
        </section>
    </main>
</body>
</html>