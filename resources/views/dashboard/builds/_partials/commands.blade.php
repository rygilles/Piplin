@if (Route::currentRouteName() == 'builds' && $current_user->is_admin)
<div class="callout">
    <h4>{{ trans('commands.build_webhook') }} <i class="piplin piplin-help text-gray" id="show_help" data-toggle="modal" data-backdrop="static" data-target="#help"></i></h4>
    <input id="webhook" value="{{ $project->build_webhook }}"> <button class="clipboard btn-link" data-clipboard-target="#webhook"><i class="piplin piplin-copy"></i></button> <button class="btn-link" id="new_webhook" title="{{ trans('commands.generate_webhook') }}" data-project-id="{{ $project->id }}" data-type="build"><i class="piplin piplin-refresh"></i></button>
    <div class="form-group">
        <div class="col-sm-9">
            <div class="checkbox">
                <label for="webhook_branch_env_link">
                    <input type="checkbox" value="1" name="webhook_branch_env_link" id="webhook_branch_env_link"
                        data-project-id="{{ $project->id }}" data-type="build"
                        {{ ($project->build_webhook_branch_env_link == 1) ? 'checked="checked"' : '' }}
                    />
                    {{ trans('commands.build_webhook_branch_env_link') }}
                </label>
            </div>
        </div>
    </div>
</div>
@endif
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ trans('commands.label') }} <i class="text-gray piplin piplin-help" data-toggle="tooltip" data-placement="right" data-original-title="{{ trans('commands.help') }}"></i></h3>
    </div>
    <div class="box-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('commands.stage') }}</th>
                    <th>{{ trans('commands.before') }}</th>
                    <th>{{ trans('commands.action') }}</th>
                    <th>{{ trans('commands.after') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['prepare', 'build', 'test', 'result'] as $index => $stage)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $buildPlan->{'before_'.$stage} }} <a href="{{ route('builds.step', ['id' => $buildPlan->id, 'command' => $stage, 'pos' => 'before']) }}"><i class="piplin piplin-plus"></i></a></td>
                    <td><a href="{{ route('builds.step', ['id' => $buildPlan->id, 'command' => $stage]) }}">{{ trans('commands.'.$stage) }}</a> <i class="piplin piplin-info" data-toggle="tooltip" data-placement="right" data-html="true" data-original-title="{!! trans('commands.'.$stage.'_help') !!}"></i></td>
                    <td>{{ $buildPlan->{'after_'.$stage} }} <a href="{{ route('builds.step', ['id' => $buildPlan->id, 'command' => $stage, 'pos' => 'after']) }}"><i class="piplin piplin-plus"></i></a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>