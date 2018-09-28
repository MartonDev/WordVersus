var wordcards = [];

function addWordCard() {

  var number = wordcards.length + 1;
  var id = "card" + number;
  var wordsContainer = document.getElementById("words");
  var wordElement = document.createElement("DIV");
  var wordTitle = document.createElement("H1");
  var deleteBtn = document.createElement("A");
  var icon = document.createElement("I");
  var wordInput = document.createElement("INPUT");
  var wordDefinition = document.createElement("INPUT");
  var titleText = document.createTextNode("Word #" + number);

  wordElement.id = id;
  wordElement.style.display = "none";
  wordTitle.id = "title" + id;
  deleteBtn.id = "delete" + id;
  wordInput.id = "word" + id;
  wordDefinition.id = "definition" + id;
  wordInput.type = "text";
  wordDefinition.type = "text";
  wordInput.placeholder = "Word";
  wordDefinition.placeholder = "Definition";

  deleteBtn.onclick = function () {

    deleteCard(deleteBtn);

  };

  wordTitle.appendChild(titleText);
  deleteBtn.appendChild(icon);
  wordElement.appendChild(wordTitle);
  wordElement.appendChild(deleteBtn);
  wordElement.appendChild(wordInput);
  wordElement.appendChild(wordDefinition);
  wordsContainer.appendChild(wordElement);

  $(wordElement).addClass("word-element");
  $(wordInput).addClass("text-input");
  $(wordDefinition).addClass("text-input");
  $(icon).addClass("fa fa-trash");

  $(wordElement).fadeIn("fast", function() {

    wordcards.push(id);
    wordElement.style.display = "inline-block";

  });

}

function deleteCard(element) {

  var indexOf = wordcards.indexOf(element.parentElement.id);

  if (indexOf > -1) {

    var idof = "#" + element.parentElement.id;

    $(element.parentElement).fadeOut("fast", function() {

      wordcards.splice(indexOf, 1);

      $(element.parentElement).remove();

      for (var i = 0; i < wordcards.length; i++) {

        var j = i + 1;
        var currCard = document.getElementById(wordcards[i]);
        var currTitle = document.getElementById("title" + wordcards[i]);
        var currDeleteBtn = document.getElementById("delete" + wordcards[i]);
        var currWordInput = document.getElementById("word" + wordcards[i]);
        var currWordDefinition = document.getElementById("definition" + wordcards[i]);
        var newId = "card" + j;

        currCard.setAttribute("id", newId);
        currTitle.setAttribute("id", "title" + newId);
        currDeleteBtn.setAttribute("id", "delete" + newId);
        currWordInput.setAttribute("id", "word" + newId);
        currWordDefinition.setAttribute("id", "definition" + newId);
        wordcards[i] = newId;

        var newTitle = document.getElementById("title" + newId);
        newTitle.innerHTML = "Word #" + j;

      }

    });

  }

}

document.getElementById("addWordCard").onclick = function () {

  addWordCard();

}

document.getElementById("submitNewCollection").onclick = function () {

  var wordsList = [];

  for (var i = 0; i < wordcards.length; i++) {

    var wordToPush = document.getElementById("word" + wordcards[i]).value;
    var definitionToPush = document.getElementById("definition" + wordcards[i]).value;
    var currWord = [wordToPush, definitionToPush];

    wordsList.push(currWord);

  }

  var newCollectionForm = document.createElement("FORM");
  var newCollectionFormName = document.createElement("INPUT");
  var newCollectionFormWords = document.createElement("INPUT");

  newCollectionForm.style.display = "none";
  newCollectionForm.action = "";
  newCollectionForm.method = "post";
  newCollectionFormName.type = "text";
  newCollectionFormName.name = "collection_name";
  newCollectionFormName.value = document.getElementById("collectionName").value;
  newCollectionFormWords.type = "text";
  newCollectionFormWords.name = "collection_words";
  newCollectionFormWords.value = JSON.stringify(wordsList);

  newCollectionForm.appendChild(newCollectionFormName);
  newCollectionForm.appendChild(newCollectionFormWords);
  document.body.appendChild(newCollectionForm);

  $(newCollectionForm).submit();

}
