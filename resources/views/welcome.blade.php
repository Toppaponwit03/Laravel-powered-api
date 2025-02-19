<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
        <button id="getResponse" class="btn btn-primary">Click Resposne</button>

        <div id="content"></div>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script>
            $('#getResponse').click(()=>{
                let htmlNode = ''
                let htmlLeaf = ''

                $.ajax({
                    url : "{{ route('resfull.show',0) }}",
                    type : 'GET',
                    data : {
                        func : 'getData',
                        _token : '{{ @CSRF_TOKEN() }}'
                    },
                    success : (res)=>{
                        console.log(res);
                        htmlNode = renderNodes(res.data)

                        $('#content').html(htmlNode)

                    },
                    error : (err) => {
                        console.log(err);
                    }

                })
            })


            function renderNodes(nodes) {
                let html = '';
                nodes.forEach(node => {
                    html += `
                        <div class="card border border-dark mb-2">
                            <div class="card-title">${node.name}</div>
                            <div class="card-body">
                                ${node.sub_category ? renderNodes(node.sub_category) : ''}
                            </div>
                        </div>`;

                });
                return html;
            }
        </script>

    </body>
</html>
