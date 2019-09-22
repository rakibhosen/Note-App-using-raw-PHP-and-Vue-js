<html>
    <head>
        <title>Note App</title>
         <!-- axios library -->
         <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/axios.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
</script>
</head>

    <body>
        <div id="app">
            <div class="container">
                    <h1 class="text-center">Note App</h1>

            <div class="card card-body" v-if="errorText.length>0">
                <div class="alert alert-danger">{{errorText}}
                   </div>
              </div>
                   

              <div class="card card-body" v-if="successText.length>0">
             <div class="alert alert-success">{{successText}}
             </div>
            </div>

           <div class="row mt-3">
               
               <div class="col-sm-3">
                   <input type="text" class="form-control" v-model="title">
               </div>

               <div class="col-sm-6">
                   <textarea class="form-control" v-model="description"></textarea>
               </div>

               <div class="col-sm-3">
               <button type="button" class="btn btn-success" @click="addNotes">Add note</button>
            </div>

           </div>

           <div class="row mt-3">
               <div class="col-md-8 offset-md-2 ">
               <div class="card card-body mt-3" v-for="(note, index) in notes.data">
                    <p><button type="button" class="btn btn-danger" @click="deleteNotes(note.id)">X</button>
                    </p>

                    <p><button type="button" class="btn btn-primary" @click="editNotes(note.id)">Edit</button>
                    </p>
                   <h1 class="text-center">{{note.title}}</h1>
                   <p class="text-center">{{note.description}}</p>
               </div>
            </div>
            <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="col-sm-12">
         <p>Note Title - {{title}}</p>
         <input type="text" v-model="title" class="form-control">
       </div>

       <div class="col-sm-12">
         <p>Note Title - {{description}}</p>
         <textarea class="form-control" v-model="description"></textarea>
       </div>

       <div class="col-sm-12">
       <p><button type="button" class="btn btn-primary mt-2" @click="updateNotes">update</button>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
           </div>

        </div>
        </div>

        <script type="text/javascript" src="js/vue.js"></script>
        <script>
            var app = new Vue({
                el: "#app",
                data: {
                    title:'',
                    description:'',
                    errorText:'',
                    successText:'',
                    selectedNote:'',
                    notes:[],
                },
        mounted(){
            var vm= this;
        vm.fetchNote();
                },

                methods:{
                    addNotes(){
                        let title = this.title;
                        let description = this.description;
                        let vm = this;
                        if(title.length > 0 && description.length > 0){

                            const singleNote = new URLSearchParams();
                            singleNote.append('title', title);
                            singleNote.append('description', description);
                            singleNote.append('author', 1);
                         

                        axios.post('http://localhost/vue/api/add-note.php',singleNote)
                            .then(function (response) {
                                vm.fetchNote();
                            })
                            .catch(function (error) {
                            console.log(error);
                           });

                        
                        this.title ="";
                        this.description="";
                        this.errorText=""
                        this.successText="Note Added";
                        }else{
                        this.errorText="Please enter some some text"
                        this.successText="";
                      
                        }
                    }, //addtNote end

                    deleteNotes(noteIndex){
                        let vm = this;
                        const singleNote = new URLSearchParams();
                        singleNote.append('id', noteIndex);
                        axios.post('http://localhost/vue/api/delete-note.php',singleNote)
                            .then(function (response) {
                                vm.fetchNote();
                            })
                            .catch(function (error) {
                            console.log(error);
                           });
                      
                        this.successText="Deleted note successfully";
                         this.errorText="";

                    }, //deleteNote end

                    editNotes(noteIndex){
                        $('#myModal').modal('show');
                        let vm = this;
                        vm.selectedNote=noteIndex;
                    // Make a request for a user with a given ID
                    axios.get('http://localhost/vue/api/show-note.php?id='+noteIndex)
                    .then(function (response) {
                        console.log(response);
                        vm.title = response.data.data.title;
                        vm.description=response.data.data.description;
                   
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
               
  
                    }, //editNote end

                    updateNotes(){

                        let vm = this;
                        const singleNote = new URLSearchParams();
                        singleNote.append('title', vm.title);
                        singleNote.append('description', vm.description);
                        singleNote.append('id',  vm.selectedNote);
                        singleNote.append('author', 1);
                    
                        axios.post('http://localhost/vue/api/edit-note.php',singleNote)
                            .then(function (response) {
                                vm.fetchNote();
                                
                        vm.title ="";
                        vm.description="";
                        vm.successText="Note Added";
                        vm.errorText="";
                        $('#myModal').modal('hide');
                     
                            })
                            .catch(function (error) {
                            console.log(error);
                           });
                       
                    }, //updateNote end

                    fetchNote(){
                     var vm=this;
                    // Make a request for a user with a given ID
                    axios.get('http://localhost/vue/api/notes.php')
                    .then(function (response) {
                        // handle success
                    vm.notes = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

                    } //fetchNote end



                }
               
               

          

      
                
            });
        </script>
    </body>
</html>