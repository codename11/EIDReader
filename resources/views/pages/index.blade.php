@extends("layouts.app")

@section("content")

    @if($members && count($members)>0)

        <div class="container-fluid grid-container2">
            
            <form class="grid-item1">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Pretraži članove" name="search">
                </div>
            </form>

            <form method="POST" action="/store" class="grid-item2" id="myform">
                @csrf
                <button type="submit" class="btn btn-outline-success content-height new-member">
                    Ubaci novog člana
                </button>
            </form>

            <table class="table grid-item3 table-hover">
                <thead>
                <tr>
                    <th scope="col">Portret</th>
                    <th scope="col">Prezime</th>
                    <th scope="col">Ime roditelja</th>
                    <th scope="col">Ime</th>
                    <th scope="col">Datum rođenja</th>
                    <th scope="col">Mesto rođenja</th>
                    <th scope="col">Država rođenja</th>
                    <th scope="col">Broj lične karte</th>
                    <th scope="col">JMBG</th>
                    <th scope="col">Datum izdavanja LK</th>
                    <th scope="col">Datum isteka LK</th>
                    <th scope="col">Akcija</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($members as $member)
                        
                        <tr onclick="location.href='/show/{{$member->id}}'; " class="getMember">
                            <td><img src={{asset($member->portrait)}} class="rounded myImage1" alt={{$member->portrait}}>
                                <br/><small>{{$member->role && $member->role->name ? $member->role->name : "/ no role"}}</small>
                            </td>
                            <td>{{$member->surname}}</td>
                            <td>{{$member->parentGivenName}}</td>
                            <td>{{$member->givenName}}</td>
                            <td>{{$member->dateOfBirth}}</td>
                            <td>{{$member->placeOfBirth}}</td>
                            <td>{{$member->stateOfBirth}}</td>
                            <td>{{$member->docRegNo}}</td>
                            <td>{{$member->personalNumber}}</td>
                            <td>{{$member->issuingDate}}</td>
                            <td>{{$member->expiryDate}}</td> 
                            <td class="grid-container1">
                                
                                <form method="POST" action="/update/{{$member->id}}" class="">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button type="submit" class="btn btn-outline-info content-height">
                                        Updejtuj člana
                                    </button>
                                </form>

                                <form method="POST" action="/delete/{{$member->id}}" class="">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger content-height">
                                        Obriši člana
                                    </button>
                                </form>

                                <form method="POST" action="/dashboard/{{$member->id}}" class="">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success content-height">
                                        Dodaj rolu
                                    </button>
                                </form>
                               
                            </td> 
                        </tr>
                        
                    @endforeach
            
                    </tbody>
                </table>

            </div>

            <div class="container-fluid grid-container3">
                <div class="pagination justify-content-center">
                    {{ $members->links("pagination::mypaginator") }}
                </div>
            </div>
        
    @endif
    
@endsection