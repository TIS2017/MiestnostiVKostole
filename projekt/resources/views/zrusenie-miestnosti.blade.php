<div class="modal" id="zrusenie" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="..." >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: rgb(255,230,213);">
    
                <form class="formular" method="POST" action="{{action('ReservationController@remove')}}">
                            {{ csrf_field() }}
    
                    <p align="center" id = "select">
                        <input type="radio" id="repeat" name="interval" value="2" checked="checked"> <label class="text od" for="repeat">Opakované stretnutie</label>
                        <input type="radio" id="only"  name="interval" value="1"> <label class="text od" for="only">Jednorázové stretnutie</label>
                    </p>         
                    <input type="hidden" name="meetingid" id="meetingid" value="">
                    <input type="hidden" name="groupname" id="groupname" value="">
                    <p align="center">
                        <button align = "center" class="button-filter" type="submit">Zrušiť</button>
                    </p>
                </form>
    
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".two", function () {
            var mid = $(this).data('meetingid');
            document.getElementById("meetingid").value = mid;
            document.getElementById("groupname").value = $(this).data('groupname');
            var repeat = $(this).data('repeat');
            if(repeat === 1){
                document.getElementById("select").style.visibility = "hidden";
            }
       });
    </script>
</div>
    


    
    
    