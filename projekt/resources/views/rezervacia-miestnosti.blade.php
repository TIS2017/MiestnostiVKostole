<div class="modal" id="rezervacia" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="..." >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: rgb(255,230,213);">
                <form class="formular" method="POST" action="{{action('ReservationController@add')}}">
                    {{ csrf_field() }}
                    <p align="center">
                        <input type="radio" id="repeat" name="interval" value="2" checked="checked"> <label class="text od" for="repeat">Opakované stretnutie</label>
                        <input type="radio" id="only"  name="interval" value="1"> <label class="text od" for="only">Jednorázové stretnutie</label>
                    </p>
                              
                    <input type="hidden" name="roomname" id="roomname" value="">
                    <input type="hidden" name="userid" id="userid" value="">
                    <input type="hidden" name="den" id="den" value="">
                    <input type="hidden" name="od" id="od" value="">
                    <input type="hidden" name="to" id="to" value="">
                    <input type="hidden" name="from" id="from" value="">
                    <input type="hidden" name="den2" id="den2" value="">
                    <input type="hidden" name="od2" id="od2" value="">

                    <p align="center">
                        <select  class="vyber" name="room_selected" id="room_selected" style="display: none;">
                            <option value="vyber"> --Vyber miestnosť-- </option>
                        </select>
                    </p>

                    <p align="center">
                        <select align = "center" class="vyber" name="group_selected" id="group_selected">
                                <option value="vyber">--- Vyber skupinu ---</option>
                        </select>
                    </p>
                        
                    <p align="center">
                        <button align = "center" class="button-filter" type="submit">Pridaj</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on("click", ".two", function () {
            var userid = $(this).data('userid');
            var od = $(this).data('od');
            var to = $(this).data('to');
            var den = $(this).data('den');
            var click = $(this).data('click');
            var roomlist = $(this).data('roomlist');
            var subadming = $(this).data("subadming");
            var roomname = $(this).data("roomname");

            if(subadming.length > 0){
                var myNode = document.getElementById("group_selected");
                if(myNode.hasChildNodes()){
                    while (myNode.firstChild) {
                        myNode.removeChild(myNode.firstChild);
                    }
                }
                subadming.forEach(function(element) 
                {
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", element['name']);
                    var t = document.createTextNode(element['name']);
                    x.appendChild(t);
                    document.getElementById("group_selected").appendChild(x);
                });
            }

            if(click != null){ // if i have to display the room selector
                document.getElementById("room_selected").style.display = "block"; 
                var myNode = document.getElementById("room_selected");
                if(myNode.hasChildNodes()){
                    while (myNode.firstChild) {
                        myNode.removeChild(myNode.firstChild);
                    }
                }
                roomlist.forEach(function(element) {
                    var x = document.createElement("OPTION");
                    x.setAttribute("value", element['name']);
                    var t = document.createTextNode(element['name']);
                    x.appendChild(t);
                    document.getElementById("room_selected").appendChild(x);
                });            
            }

            document.getElementById("userid").value = userid;
            document.getElementById("den").value = den;
            document.getElementById("od").value = od;
            document.getElementById("to").value = to;
            document.getElementById("from").value = $(this).data('from');
            document.getElementById("roomname").value = roomname;
            document.getElementById("den2").value = den;
            document.getElementById("od2").value = od;
        
    })
    </script>
</div>

