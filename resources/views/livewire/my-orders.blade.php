<div>
   <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <div class="card">
                 <p class="heading pb-1 text-center">My Orders</p>
               <table clas="table" wire:loading.delay.class="opacity-50">
                   <tbody>
                    <thead>
                        <tr>
                            <td>SN</td>
                            <th>Ord#</th>
                            <th>Total (Rs.)</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                       @forelse($myorders as $index => $order)
                        <tr>
                            <td>{{$index + $myorders->firstItem()}}</td>
                           <td><a href="#" title="order detail">{{ $order -> order_number }}</a>
                            <br />
                            ({{ date('d-M-y',strtotime($order -> created_at)) }})</td>
                           <td>{{ $order -> grand_total }}</td>
                          
                            <td>

                                @if ( $order -> status == 'cancelled')
                                <span class="text-danger">{{ $order -> status }}</span>
                                @endif

                                @if ($order -> status == 'processing')
                                    <span class="text-warning">{{ $order -> status }}</span>
                                @endif

                                @if ($order -> status == 'completed')
                                 <span class="badge badge-success">{{ $order -> status }}</span>
                                @endif

                                @if ($order -> status == 'pending')
                                 <span class="text-info">{{ $order -> status }}</span>
                                @endif 

                                @if ($order -> status == 'declined')
                                 <span class="badge badge-secondary">{{ $order -> status }}</span>
                                 @endif
                            </td>
                           
                           <td>
                             @if ($order -> status == 'pending' || 
                                $order -> status == 'processing')
                               <a href="javascript:;" wire:click="cancelOrder({{ $order -> id }})" onclick="confirm('Are you sure?!') || event.preventDefault();">Cancel</a>

                            @endif
<span wire:loading wire:target="cancelOrder({{ $order -> id }})">
                                      <i class="fa fa-spin fa-spinner"></i>
                           </td>

                        </tr>

                       @empty
                        <tr><td colspan="4">No order yet!</td></tr>

                       @endforelse
                   </tbody>
               </table>
 {{ $myorders->links() }}
            </div>
            </div>
            
        </div>
    </div>
</div>
