@extends ('layout.master')
@section('main_content')
   <div>
      <h3>Account Setting</h3>
   </div>
   <div>
      <button date-user_name ="{{ $user -> name }} " id ="generateapi" class="btn btn-primary">Generate API Key</button>
   </div>
   <div class="mt-4 mb-4" id="result_api"> </div>
@endsection

@section('page_title')
   Account Setting
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var generateApiButton = document.getElementById('generateapi');

    if (generateApiButton) {
        
        generateApiButton.addEventListener('click', function () {
            fetch('/admin/token/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf_token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    'token_name': "API Token for " + this.getAttribute('data-user_name')
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok. Status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('result_api').innerHTML = data.token;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    } else {
        console.error('Element with id "generateapi" not found.');
    }
});

</script>
