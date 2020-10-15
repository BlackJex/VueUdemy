<template>
  <div class="">
    <a v-if="canAccept" :class="classes" class="cursor-pointer"
      title="Mark this answer as best answer"
      @click.prevent="create">
      <i class="fa fa-check fa-2x"></i>
    </a>
    <a v-if="accepted" :class="classes"
      title="Accepted Answer">
      <i class="fa fa-check fa-2x"></i>
    </a>
  </div>
</template>

<script>
export default {
  props: ['answer'],

  data()
  {
    return {
      isBest: this.answer.is_best,
      id: this.answer.id
    }
  },
  computed: {
    canAccept()
    {
       return true;
    },
    accepted()
    {
      return !this.canAccept && this.isBest;
    },
    classes()
    {
      return [
        'mt-2',
        this.isBest ? 'vote-accept' : ''
      ];
    }
  },
  methods: {
    create()
    {
      axios.post(`/answer/${this.id}/accept`)
      .then((res) => {
        this.$toast.success(res.data.message, 'Success', {
          timeout: 3000,
          position: 'bottomLeft'
        });
        this.isBest = true;
      });
    }
  }
}
</script>
