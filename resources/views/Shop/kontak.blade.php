<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="{{route('bayar-tagihan')}}" method="POST">
        @csrf
        <button type="submit" id="pay-button" style="display: none;">Pay!</button>
    </form>

    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(event){
        event.preventDefault();
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          onPending: function(result){
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          onError: function(result){
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>


  </body>
</html>
