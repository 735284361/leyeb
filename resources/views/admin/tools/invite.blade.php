<div class="btn-group" data-toggle="buttons">
    <a class='report-posts btn btn-sm btn-info' onclick="getCode()"><i class='fa fa-qrcode'></i> 邀请</a>
</div>

<script>
    let headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    function getCode()
    {
        Swal.fire({
            type: 'question',
            title: '请选择数量？',
            input: 'range',
            inputAttributes: {
                min: 1,
                max: 10,
                step: 1
            },
            inputValue: 5,
            showCancelButton: true,
            confirmButtonText: '确认',
            cancelButtonText: '取消',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{route('admin.company.invite-token')}}", // Invalid URL on purpose
                    type: 'GET',
                    headers: headers,
                    data: {
                        number: result.value
                    }
                })
                    .done(function(data) {
                        if (data.code == 0) {
                            Swal.fire('操作成功').then(function(){
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                'title': '失败',
                                'text': data.msg,
                                'type': 'success'
                            }).then(function(){
                                location.reload();
                            });
                        }
                        resolve(data)
                    })
                    .fail(function(error) {
                        reject(error)
                    });
            }
        })



    }

</script>
