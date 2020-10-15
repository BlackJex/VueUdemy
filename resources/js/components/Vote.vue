<template>
  <div class="d-flex flex-column vote-controls">
    <a :title="title('up')" @click.prevent="voteUp"
       class="vote-up" :class="classes">
      <i class="fa fa-caret-up fa-3x"></i>
    </a>
    <span class="votes-count">{{ count }}</span>
    <a :title="title('down')" @click.prevent="voteDown"
       class="vote-down" :class="classes">
      <i class="fa fa-caret-down fa-3x"></i>
    </a>
    <favorite v-if="name == 'question'" :question="model"></favorite>
    <accept v-else :answer="model"></accept>
  </div>
</template>

<script>
import Favorite from './Favorite.vue';
import Accept from './Accept.vue';

export default {

  props: [
    'name',
    'model'
  ],
  data()
  {
    return{
      count : this.model.votes_count,
      id: this.model.id
    }
  },
  computed: {
    classes()
    {
      return  this.signedIn ? '' : 'off';
    },
    endpoint()
    {
      return `/${this.name}/${this.id}/vote `;
    }
  },
  components: {
    Favorite,
    Accept
  },
  methods: {
    title(voteType)
    {
      let title = {
        up: `This ${this.name} is useful`,
        down: `This ${this.name} is not useful`
      }
      return title[voteType];
    },
    voteUp()
    {
      this._vote(1);
    },
    voteDown()
    {
      this._vote(-1);
    },
    _vote(vote)
    {
      if(!this.signedIn)
      {
        this.$toast.warning(`Login to vote the  ${ this.name }`, 'Please', {
          timeout: 3000,
          position: 'bottomLeft'
        });

        return;
      }
      axios.post(this.endpoint, {
        vote: vote
      })
      .then((res) => {
        this.$toast.success(res.data.message, 'Success', {
          timeout: 3000,
          position: 'bottomLeft'
        });

        this.count = res.data.votesCount;
      });
    }
  }

}
</script>
