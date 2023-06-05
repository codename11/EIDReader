@extends("layouts.app")

@section("content")
    
    @if($response->member)

        <div class="card myCard1 cent">

            <div class="card-header alert alert-warning">{{$response->message}}</div>
            
            <div class="myImage"><img src={{asset($response->member->portrait)}} class="rounded" alt={{$response->member->portrait}}></div>
            <div class="card-body grid-container1">

                <div>
                    <div><strong>Prezime:</strong> <span>{{$response->member->surname}}</span></div>
                    <div><strong>Ime roditelja:</strong> <span>{{$response->member->parentGivenName}}</span></div>
                    <div><strong>Ime:</strong> <span>{{$response->member->givenName}}</span></div>
                    <div><strong>Datum rođenja:</strong> <span>{{$response->member->dateOfBirth}}</span></div>
                    <div><strong>Mesto rođenja:</strong> <span>{{$response->member->placeOfBirth}}</span></div>
                </div>

                <div>
                    <div><strong>Država rođenja:</strong> <span>{{$response->member->stateOfBirth}}</span></div>
                    <div><strong>Broj lične karte:</strong> <span>{{$response->member->docRegNo}}</span></div>
                    <div><strong>JMBG:</strong> <span>{{$response->member->personalNumber}}</span></div>
                    <div><strong>Datum izdavanja LK:</strong> <span>{{$response->member->issuingDate}}</span></div>
                    <div><strong>Datum isteka LK:</strong> <span>{{$response->member->expiryDate}}</span></div>
                </div>
            
            </div>
            <div class="card-footer text-muted grid-container1">
                <p>Iščitani podaci sa lične karte:</p>
                <form method="GET" action="/index" class="">
                    <button type="submit" class="btn btn-outline-success content-height">
                        Vrati se na početak
                    </button>
                </form>
            </div>
        </div>

    @endif
    
@endsection