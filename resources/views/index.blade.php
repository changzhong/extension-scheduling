<script data-exec-on-popstate>
    $(function () {
        $('.run-task').click(function (e) {
            var id = $(this).data('id');
            // NProgress.start();
            $.ajax({
                method: 'POST',
                url: '{{route('scheduling-run')}}',
                data: {id: id, _token: Dcat.token},
                success: function (data) {
                    if (typeof data === 'object') {
                        $('.output-box').removeClass('hidden');
                        $('.output-box .output-body').html(data.data);
                    }
                    // NProgress.done();
                }
            });
        });
    });
</script>

<style>
    .output-body {
        white-space: pre-wrap;
        background: #000000;
        color: #00fa4a;
        padding: 10px;
        border-radius: 0;
    }

</style>

<div class="box">
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>任务</th>
                <th>运行时间</th>
                <th>下次运行时间</th>
                <th>简介</th>
                <th>运行</th>
            </tr>
            @foreach($events as $index => $event)
                <tr>
                    <td>{{ $index+1 }}.</td>
                    <td><code>{{ $event['task']['name'] }}</code></td>
                    <td><span class="label label-success">{{ $event['expression'] }}</span>&nbsp;{{ $event['readable'] }}</td>
                    <td>{{ $event['nextRunDate'] }}</td>
                    <td>{{ $event['description'] }}</td>
                    <td><a class="btn btn-xs btn-primary run-task" data-id="{{ $index+1 }}">Run</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-default output-box hidden">
    <div class="box-header with-border">
        <h3 class="box-title">输出结果 <small>（后台执行的进程不会返回结果）</small></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <pre class="output-body"></pre>
    </div>
    <!-- /.box-body -->
</div>
