<template>
  <div class="overflow-auto">
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
    <b-table
      id="my-table"
      :items="items"
      :per-page="perPage"
      :current-page="currentPage"
      small
      :filter="filter"
      :filterIncludedFields="filterOn"
      @filtered="onFiltered"
    ></b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="totalRows"
      :per-page="perPage"
      aria-controls="my-table"
      align="fill"
    ></b-pagination>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      perPage: 0,
      currentPage: 1,
      totalRows: 1,
      filter: null,
      filterOn: [],
      items: []
    };
  },
   watch: {
    currentPage: {
      handler: function(value) {
        this.fetchMembers();
      }
    }
  },
  mounted() {
    this.fetchMembers();
  },
  methods: {
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length === this.items.length ? 1000 : filteredItems.length;
      this.currentPage = 1;
    },
    fetchMembers() {
      axios
        .get("/api/v1/members?page=" + this.currentPage)
        .then(res => {
          this.items = res.data.data;
          this.totalRows = 1000;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  computed: {
    rows() {
      return this.items.length;
    }
  }
};
</script>