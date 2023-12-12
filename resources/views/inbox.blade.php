@extends('dashboard')
@section('title','Inbox')
@section('content')

<div class="container d-flex  mt-5" style="min-height: 100vh;">
        
        <div class="centered-div">
            <div class="inbox-section">
                <!-- Search bar -->
                <div class="search-bar">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control no-effects " placeholder="Search...">
                    </div>
                </div>
                <!-- Recent chats -->
                <div class="chat-item">
                    <img src="images/profile 1.png" class="profile-pic" alt="Profile Picture">
                    <div class="chat-info">
                        <span class="chat-name">John Doe</span>
                        <span class="recent-chat">This is the recent chat message.</span>
                    </div>
                </div>
                <div class="chat-item">
                    <img src="images/profile 1.png"class="profile-pic" alt="Profile Picture">
                    <div class="chat-info">
                        <span class="chat-name">Jane Smith</span>
                        <span class="recent-chat">Another recent chat message.</span>
                    </div>
                </div>
                <div class="chat-item">
                    <img src="images/profile 1.png"class="profile-pic" alt="Profile Picture">
                    <div class="chat-info">
                        <span class="chat-name">Jane Smith</span>
                        <span class="recent-chat">Another recent chat message.</span>
                    </div>
                </div>
                <div class="chat-item">
                    <img src="images/profile 1.png"class="profile-pic" alt="Profile Picture">
                    <div class="chat-info">
                        <span class="chat-name">Jane Smith</span>
                        <span class="recent-chat">Another recent chat message.</span>
                    </div>
                </div>
                <div class="chat-item">
                    <img src="images/profile 1.png"class="profile-pic" alt="Profile Picture">
                    <div class="chat-info">
                        <span class="chat-name">Jane Smith</span>
                        <span class="recent-chat">Another recent chat message.</span>
                    </div>
                </div>
                <!-- Add more chat items here -->
            </div>
            <div class="message-section" id="message-section" style="display: none;">
                <div class="message-initial"> 
                    <label class="new-message-label">New Message</label>
                    <img src="images/🦆 icon _instagram_.svg" alt="Message Image" style="width: 50px; height: 30px; margin-top: 7px; margin-left: 340px; margin-right: 70px;">
                
                    <div class="message-image">
                        <img src="images/profile 1.png" alt="Profile Image" style="border-radius: 80px;">
                    </div>
                    <center><label>John Lewis</label></center>
                    <div class="chat-messages-container" id="chat-messages-container">
                        <!-- Add this HTML structure inside the .chat-messages-container div --></div>

                    </div>

                    <div class="text-area">
                        <div class="custom-icons">
                            <img src="images/🦆 icon _emoji happy_.svg" alt="Icon 1" class="custom-icon">
                            <img src="images/🦆 icon _gallery_.svg" alt="Icon 2" class="custom-icon">
                        </div>
                        <textarea id="myTextarea" name="myText" rows="5" cols="40" placeholder="Type Message here"></textarea>
                        <img src="images/🦆 icon _send 2_.svg" alt="Custom Icon"  style="margin-top: -90px; width: 28px; margin-right: 32px;">
                        

                    </div>
                </div> 
            </div>
            
            
            
            
            
            

            
        </div>

        <!-- Add this modal structure outside of the .centered-div -->
<div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="optionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="optionsModalLabel">Message Options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger" id="deleteButton">Delete</button>
                <button class="btn btn-primary" id="replyButton">Reply</button>
            </div>
        </div>
    </div>
</div>

    </div>

<script>
  $(document).ready(function () {
  // References to elements
  var $messageSection = $('#message-section');
  var $chatItems = $('[class^="chat-item"]');
  var $chatMessagesContainer = $('#chat-messages-container');
  var $messageImage = $('.message-image img');
  var $messageLabel = $('center label:contains("John Lewis")');
  var $newMessageLabel = $('.new-message-label');
  var labelSet = false;
  var messageImageSrc = $messageImage.attr('src');
  var messageLabelText = $messageLabel.text();

  // Function to handle chat item click
  $chatItems.click(function () {
    // Remove the active class from all chat items
    $chatItems.removeClass('active');
    // Apply the effects to the clicked chat item
    $(this).addClass('active');
    // Show the message section
    $messageSection.css('display', 'block');
  });

  // Function to handle send button click
  $('#myTextarea + img').click(function () {
    var messageText = $('#myTextarea').val().trim();
    if (messageText !== '') {
      if (!labelSet) {
        $messageLabel.parent().remove();
        labelSet = true;
        $newMessageLabel.text(messageLabelText);
        $messageImage.attr('src', messageImageSrc);
        $messageImage.css('width', '30px');
        $messageImage.css('height', '30px');
        $messageImage.css('margin-top', '5px');
        $messageImage.css('border-radius', '50%');
      }

      var messageElement = document.createElement('div');
      messageElement.className = 'chat-message';
      messageElement.textContent = messageText;

      $chatMessagesContainer.append(messageElement);
      $('#myTextarea').val('');
      $chatMessagesContainer.scrollTop($chatMessagesContainer[0].scrollHeight);
    }
  });

  // Delegated click event for chat messages
  $chatMessagesContainer.on('click', '.chat-message', function () {
    // Store the clicked message
        var $selectedMessage = $(this);

        // Show the menu modal
        showOptionsModal($selectedMessage);
    });

    var $optionsModal = $('#optionsModal');
    var $deleteButton = $('#deleteButton');
    var $replyButton = $('#replyButton');

    // Function to show the options modal
    function showOptionsModal($selectedMessage) {
        $optionsModal.modal('show');

        // Attach the selected message to the modal
        $optionsModal.data('message', $selectedMessage);
    }

    // Function to handle delete button click
    $deleteButton.click(function () {
        var $selectedMessage = $optionsModal.data('message');
        $selectedMessage.remove();
        $optionsModal.modal('hide');
    });

    // Function to handle reply button click (customize this based on your needs)
    $replyButton.click(function () {
        // Implement your reply functionality here
        $optionsModal.modal('hide');
    });
    });


    
</script>
@endsection()