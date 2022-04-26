import Vue from 'vue'

Vue.mixin({
    data(){
      return{}
    },
    computed: {
        getTotalTableData() {
            return this.table.data.length;
        }
    },
    methods: {

        ImageUpload(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                    this.imageFile = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                alert('File size can not be bigger than 2 MB')
            }

            return this.imageFile;

        }


    }
});

