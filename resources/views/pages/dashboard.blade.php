@extends("layouts.app")

@section("content")

    @if($roles && count($roles)>0 && $member)
    
        <div class="grid-container1 cent role-container">
            <h3 class="role-item1">Dodavanje / menjanje role</h3>
            <form method="POST" action="/dashboard/update_member_role" class="">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <input type="hidden" name="member_id" value={{$member->id}}>

                <div class="form-group">
                    {{$member->surname}} {{$member->parentGivenName}} {{$member->givenName}}{{" / "}}{{$member && $member->role && $member->role->name ? $member->role->name : "no role"}}
                </div>
                <div class="form-group">
                    <select class="form-control" aria-label="Default select example" name="role_id">
                        @foreach($roles as $role)

                            <option value={{$role && $role->id ? $role->id : null}}>{{$role && $role->name ? $role->name : null}}</option>

                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success content-height">
                    Uradi rolu
                </button>

            </form>

            <form method="GET" action="/index" class="role-item2">
                <button type="submit" class="btn btn-outline-info content-height">
                    Vrati se na početak
                </button>
            </form>

        </div>

    @endif

@endsection