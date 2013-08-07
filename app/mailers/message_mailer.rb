class MessageMailer < ActionMailer::Base
  default from: "lior.sion@gmail.com"

  def message_received(runner)
  	@runner = runner
    mail(:to => runner.email, :subject => "Message Received")
  end

  def pacing_approved(message)
  	@message = message
  	mail(:to => message.sender.email, :subject => "Pacing Offer Approved")
  end

  def pacing_rejected(message)
  	@message = message
  	mail(:to => message.sender.email, :subject => "Pacing Offer Rejected")
  end
end
