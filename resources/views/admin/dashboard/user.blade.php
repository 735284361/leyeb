<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">用户列表</h3>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        @if (!count($users))
        暂无数据~
        @else
        <div class="table-responsive">
            <table class="table table-striped">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td>
                            <a href="" class="product-title">学习数据</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="admin/vip-company-users" class="uppercase">查看更多</a>
    </div>
    <!-- /.box-footer -->
</div>
