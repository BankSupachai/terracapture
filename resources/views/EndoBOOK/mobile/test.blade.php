<div id="q-app">
    <div class="row q-gutter-md">
      <q-select class="col-2" v-model="mini" :options="miniOptions" label="Mini mode" outlined="outlined" dense="dense" options-dense="options-dense"></q-select>
      <q-toggle v-model="dark">Dark</q-toggle>
      <q-select class="col" v-model="firstDayWeek" label="First day week" outlined="outlined" dense="dense" options-dense="options-dense" :options="days" map-options="map-options" emit-value="emit-value"></q-select>
    </div><br/>
    <q-calendar :events="events" @event="onEvent" :mini="mini" :dark="dark" :first-day-week="firstDayWeek"></q-calendar>
  </div>
