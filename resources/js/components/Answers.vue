<template>
      <div class="row mt-5 justify-content-center" v-cloak v-if="count">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h2>{{ title }}</h2>
          </div>
          <hr>
          <answer v-for="answer in answers" :answer="answer" :key="answer.id"></answer>
          <div class="text-center mt-3" v-if="nextUrl">
            <button  class="btn btn-outline-secondary" @click.prevent="fetch(nextUrl)">Load more answers</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Answer from './Answer.vue';

  export default {
      props: ['question'],
      data()
      {
        return{
          questionIn: this.question.id,
          count: this.question.answers_count,
          answers: [],
          nextUrl: null
        }
      },
      created()
      {
        this.fetch(`/question/${this.question.id}/answer`);
      },
      methods: 
      {
        fetch(endpoint)
        {
          axios.get(endpoint)
          .then(({data}) => {
            this.answers.push(...data.data);
            this.nextUrl = data.next_page_url;
          })
        }
      },
      computed: 
      {
        title()
        {
          return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
        }
      },
      components: 
      {
        Answer
      }
  }
</script>