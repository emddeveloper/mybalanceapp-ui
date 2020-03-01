<template>
  <div class="about mt-2">
    <div class="loader" v-if="loading">
				<img src="../assets/3.gif">
			</div>
   <table class="table">
    <thead>
      <tr class="table-header">
        <th>SL.</th>
        <th>SC</th>
        <th>Allahabad</th>
        <th>SBI</th>
        <th>Last Update</th>
      </tr>
    </thead>
    <tbody>     
      <tr class="" v-for="(x,index) in appdata" :key=index :class="(index%2==0) ? 'table-success' :'table-warning'">
        <td class="text-center">{{x.myid}}</td>
        <td class="text-right">&#8377;{{x.scbal}}</td>
        <td class="text-right">&#8377;{{x.alabal}}</td>
        <td class="text-right">&#8377;{{x.sbibal}}</td>
        <td class="text-center f-10">{{x.tstamp}}</td>
      </tr>
      <!-- <tr class="table-danger">
        <td>2</td>
        <td>Moe</td>
        <td>mary@example.com</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr> -->
    </tbody>
  </table>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name:'about',
  data:function(){
    return{
        appdata:{},
        loading:false
    }
  },
  created(){
    this.getallbalance()
  },
  methods:{
    getallbalance(){
      this.loading=true;
			axios.get(`http://balance.emddeveloper.com/api/mybalance.php?action=readall`)
			.then(response => {
			// JSON responses are automatically parsed.
       this.appdata = response.data.balance
        this.loading=false;
			})
			.catch(e => {
         this.loading=false;
			//this.errors.push(e)
			})
		}
  }
}
</script>
<style scoped>
.table-header{
  background: #141111a6;
    color: #fff;
    font-size: 12px;
}
.table td {
    padding: 5px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    font-size: 11px;
        vertical-align: middle;
}
@media(max-width:400px){
.f-10{
  font-size: 10px !important;
}
}

</style>