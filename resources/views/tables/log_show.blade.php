@extends('admin_layout')

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Log</h4>
                <div class="card-body">
                    @can('admin')
                    <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <th scope="row">Title:</th>
                                <td></td>
                              </tr>
                              <tr>
                                <th scope="row">Description:</th>
                                <td></td>
                              </tr>
                              <tr>
                                <th scope="row">Estimated Price:</th>
                                <td></td>
                              </tr>
                              
                            </tbody>
                          </table>

                        
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                    <a href="{{url()->previous()}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection