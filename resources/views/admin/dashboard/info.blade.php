<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">会员信息</h3>

    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <td width="120px">公司名称</td>
                    <td>{{ $info['company'] }}</td>
                </tr>
                <tr>
                    <td width="120px">联系人</td>
                    <td>{{ $info['contact_name'] }}</td>
                </tr>
                <tr>
                    <td width="120px">联系电话</td>
                    <td>{{ $info['contact_phone'] }}</td>
                </tr>
                <tr>
                    <td width="120px">联系邮箱</td>
                    <td>{{ $info['contact_email'] }}</td>
                </tr>
                <tr>
                    <td width="120px">城市</td>
                    <td>{{ $info['city'] }}</td>
                </tr>
                <tr>
                    <td width="120px">会员到期时间</td>
                    <td><mark style="color: red">{{ $info['end_at'] }}</mark></td>
                </tr>
                <tr>
                    <td width="120px">最大成员数</td>
                    <td><mark style="color: red">{{ $info['member_count'] }}人</mark></td>
                </tr>
                <tr>
                    <td width="120px">创建时间</td>
                    <td>{{ $info['created_at'] }}</td>
                </tr>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>
