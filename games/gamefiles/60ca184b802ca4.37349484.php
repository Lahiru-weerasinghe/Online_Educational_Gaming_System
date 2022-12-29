<!-- This is a sample game for our site. 
we got this from codepen(https://codepen.io/phantomesse/pen/YPrqLJ). 
we have done some necessary changes to suit our requirements. -->

<style>
.g-container {
  background: darkcyan;
  text-align: center;
  width: 1000px;
  height: 500px;
  border-radius: 20px;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.65);
}
.g-container {
  display: table-cell;
  vertical-align: middle;
}

#quiz {
  margin: 0px 50px 0px;
  position: relative;
  width: calc(100% - 100px);
}

#quiz h1 {
  color: #FAFAFA;
  font-weight: 600;
  font-size: 36px;
  text-transform: uppercase;
  text-align: left;
  line-height: 44px;
}

#quiz button {
  margin-top: 20px;
  background-color: white;
  border: solid 1px rgb(224, 217, 217);
  border-radius: 4px;
  cursor: pointer;
  box-shadow: inset 0 0 0 2px black;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);

  white-space: nowrap;
  padding: 10px 20px;
  margin-left: 20px;
  width: 150px;
  font-family: "Bree Serif", serif;
  font-size: 15px;
  color: black;
}

#quiz button:hover {
  color: red;
  box-shadow: inset 0 0 0 2px red;
  border: none;
}

#quiz button:disabled {
  opacity: 0.5;
  background: gray;
  color: #00403C;
  cursor: default;
}

#question {
  padding: 20px;
  background: #FAFAFA;
  box-sizing: border-box;
}

#question h2 {
  margin-bottom: 16px;
  font-weight: 600;
  font-size: 20px;
}

#question input[type=radio] {
  display: none;
  box-sizing: border-box;
}

#question label {
  display: inline-block;
  margin: 4px;
  padding: 8px;
  background: #FAE3BB;
  color: #4C3000;
  width: calc(50% - 8px);
  min-width: 100px;
  cursor: pointer;
  box-sizing: border-box;
}

#question label:hover {
  background: #EBBB67;
}

#question input[type=radio]:checked + label {
  background: #CB8306;
  color: #FAFAFA;
  box-sizing: border-box;
}

#quiz-results {
  display: flex;
  flex-direction: column;
  justify-content: center;
  position: absolute;
  top: 44px;
  left: 0px;
  background: #FAFAFA;
  width: 100%;
  height: calc(100% - 44px);
  box-sizing: border-box;
}

#quiz-results-message {
  display: block;
  color: #00403C;
  font-size: 20px;
  font-weight: bold;
  box-sizing: border-box;
}

#quiz-results-score {
  display: block;
  color: #31706c;
  font-size: 20px;
  box-sizing: border-box;
}

#quiz-results-score b {
  color: #00403C;
  font-weight: 600;
  font-size: 20px;
  box-sizing: border-box;
}

</style>

<div class= "g-container">
    <div id="quiz">
    <h1 id="quiz-name"></h1>
    <button id="prev-question-button">Previous</button>
    <button id="next-question-button">Next Question</button>
    <button id="submit-button">Submit Answers</button>
    
    <div id="quiz-results">
        <p id="quiz-results-message"></p>
        <p id="quiz-results-score"></p>
    </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    // Array of all the questions and choices to populate the questions. This might be saved in some JSON file or a database and we would have to read the data in.
var all_questions = [{
  question_string: "5 + 31?",
  choices: {
    correct: "36",
    wrong: ["35", "34", "37"]
  }
}, {
  question_string: "6 + 22?",
  choices: {
    correct: "28",
    wrong: ["25", "26", "27"]
  }
}, {
  question_string: "7 + 12?",
  choices: {
    correct: "19",
    wrong: ["20", "18", "21"]
  }
}, {
  question_string: "8 + 23?",
  choices: {
    correct: "31",
    wrong: ["32", "30", "33"]
  }
}, {
  question_string: "9 + 21?",
  choices: {
    correct: "30",
    wrong: ["29", "31", "32"]
  }
}, {
  question_string: "10 + 34?",
  choices: {
    correct: "44",
    wrong: ["42", "43", "45"]
  }
}, {
  question_string: "11 + 56?",
  choices: {
    correct: "57",
    wrong: ["55", "56", "58"]
  }
}, {
  question_string: "12 + 32?",
  choices: {
    correct: "44",
    wrong: ["43", "45", "46"]
  }
}, {
  question_string: "13 + 23?",
  choices: {
    correct: "36",
    wrong: ["34", "35", "37"]
  }
}, {
  question_string: "14 + 23?",
  choices: {
    correct: "37",
    wrong: ["34", "35", "36"]
  }
}];

// An object for a Quiz, which will contain Question objects.
var Quiz = function(quiz_name) {
  // Private fields for an instance of a Quiz object.
  this.quiz_name = quiz_name;
  
  // This one will contain an array of Question objects in the order that the questions will be presented.
  this.questions = [];
}

// A function that you can enact on an instance of a quiz object. This function is called add_question() and takes in a Question object which it will add to the questions field.
Quiz.prototype.add_question = function(question) {
  // Randomly choose where to add question
  var index_to_add_question = Math.floor(Math.random() * this.questions.length);
  this.questions.splice(index_to_add_question, 0, question);
}

// A function that you can enact on an instance of a quiz object. This function is called render() and takes in a variable called the container, which is the <div> that I will render the quiz in.
Quiz.prototype.render = function(container) {
  // For when we're out of scope
  var self = this;
  
  // Hide the quiz results modal
  $('#quiz-results').hide();
  
  // Write the name of the quiz
  $('#quiz-name').text(this.quiz_name);
  
  // Create a container for questions
  var question_container = $('<div>').attr('id', 'question').insertAfter('#quiz-name');
  
  // Helper function for changing the question and updating the buttons
  function change_question() {
    self.questions[current_question_index].render(question_container);
    $('#prev-question-button').prop('disabled', current_question_index === 0);
    $('#next-question-button').prop('disabled', current_question_index === self.questions.length - 1);
    
    // Determine if all questions have been answered
    var all_questions_answered = true;
    for (var i = 0; i < self.questions.length; i++) {
      if (self.questions[i].user_choice_index === null) {
        all_questions_answered = false;
        break;
      }
    }
    $('#submit-button').prop('disabled', !all_questions_answered);
    $('#save-btn').prop('disabled', !all_questions_answered);
  }
  
  // Render the first question
  var current_question_index = 0;
  change_question();
  
  // Add listener for the previous question button
  $('#prev-question-button').click(function() {
    if (current_question_index > 0) {
      current_question_index--;
      change_question();
    }
  });
  
  // Add listener for the next question button
  $('#next-question-button').click(function() {
    if (current_question_index < self.questions.length - 1) {
      current_question_index++;
      change_question();
    }
  });
  
  // Add listener for the submit answers button
  $('#submit-button').click(function() {
    // Determine how many questions the user got right
    var score = 0;
    for (var i = 0; i < self.questions.length; i++) {
      if (self.questions[i].user_choice_index === self.questions[i].correct_choice_index) {
        score++;
      }
    }
    
    // Display the score with the appropriate message
    var percentage = score / self.questions.length;
    console.log(percentage);
    var message;
    if (percentage === 1) {
      message = 'Great job!'
    } else if (percentage >= .75) {
      message = 'You did alright.'
    } else if (percentage >= .5) {
      message = 'Better luck next time.'
    } else {
      message = 'Maybe you should try a little harder.'
    }
    $('#quiz-results-message').text(message);
    $('#quiz-results-score').html('You got <b>' + score + '/' + self.questions.length + '</b> questions correct.');
    $('#score').val(score);
    $('#quiz-results').slideDown();
    $('#quiz button').slideUp();
  });
  
  // Add a listener on the questions container to listen for user select changes. This is for determining whether we can submit answers or not.
  question_container.bind('user-select-change', function() {
    var all_questions_answered = true;
    for (var i = 0; i < self.questions.length; i++) {
      if (self.questions[i].user_choice_index === null) {
        all_questions_answered = false;
        break;
      }
    }
    $('#submit-button').prop('disabled', !all_questions_answered);
    $('#save-btn').prop('disabled', !all_questions_answered);
  });
}

// An object for a Question, which contains the question, the correct choice, and wrong choices. This block is the constructor.
var Question = function(question_string, correct_choice, wrong_choices) {
  // Private fields for an instance of a Question object.
  this.question_string = question_string;
  this.choices = [];
  this.user_choice_index = null; // Index of the user's choice selection
  
  // Random assign the correct choice an index
  this.correct_choice_index = Math.floor(Math.random() * wrong_choices.length + 1);
  
  // Fill in this.choices with the choices
  var number_of_choices = wrong_choices.length + 1;
  for (var i = 0; i < number_of_choices; i++) {
    if (i === this.correct_choice_index) {
      this.choices[i] = correct_choice;
    } else {
      // Randomly pick a wrong choice to put in this index
      var wrong_choice_index = Math.floor(Math.random(0, wrong_choices.length));
      this.choices[i] = wrong_choices[wrong_choice_index];
      
      // Remove the wrong choice from the wrong choice array so that we don't pick it again
      wrong_choices.splice(wrong_choice_index, 1);
    }
  }
}

// A function that you can enact on an instance of a question object. This function is called render() and takes in a variable called the container, which is the <div> that I will render the question in. This question will "return" with the score when the question has been answered.
Question.prototype.render = function(container) {
  // For when we're out of scope
  var self = this;
  
  // Fill out the question label
  var question_string_h2;
  if (container.children('h2').length === 0) {
    question_string_h2 = $('<h2>').appendTo(container);
  } else {
    question_string_h2 = container.children('h2').first();
  }
  question_string_h2.text(this.question_string);
  
  // Clear any radio buttons and create new ones
  if (container.children('input[type=radio]').length > 0) {
    container.children('input[type=radio]').each(function() {
      var radio_button_id = $(this).attr('id');
      $(this).remove();
      container.children('label[for=' + radio_button_id + ']').remove();
    });
  }
  for (var i = 0; i < this.choices.length; i++) {
    // Create the radio button
    var choice_radio_button = $('<input>')
      .attr('id', 'choices-' + i)
      .attr('type', 'radio')
      .attr('name', 'choices')
      .attr('value', 'choices-' + i)
      .attr('checked', i === this.user_choice_index)
      .appendTo(container);
    
    // Create the label
    var choice_label = $('<label>')
      .text(this.choices[i])
      .attr('for', 'choices-' + i)
      .appendTo(container);
  }
  
  // Add a listener for the radio button to change which one the user has clicked on
  $('input[name=choices]').change(function(index) {
    var selected_radio_button_value = $('input[name=choices]:checked').val();
    
    // Change the user choice index
    self.user_choice_index = parseInt(selected_radio_button_value.substr(selected_radio_button_value.length - 1, 1));
    
    // Trigger a user-select-change
    container.trigger('user-select-change');
  });
}

// "Main method" which will create all the objects and render the Quiz.
$(document).ready(function() {
  // Create an instance of the Quiz object
  var quiz = new Quiz('My Quiz (This is a sample game)');
  
  // Create Question objects from all_questions and add them to the Quiz object
  for (var i = 0; i < all_questions.length; i++) {
    // Create a new Question object
    var question = new Question(all_questions[i].question_string, all_questions[i].choices.correct, all_questions[i].choices.wrong);
    
    // Add the question to the instance of the Quiz object that we created previously
    quiz.add_question(question);
  }
  
  // Render the quiz
  var quiz_container = $('#quiz');
  quiz.render(quiz_container);

});
</script>