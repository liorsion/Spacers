class Message < ActiveRecord::Base
	belongs_to :race
	belongs_to :sender, foreign_key: :sender_id,  class_name: "Runner"
	belongs_to :receiver, foreign_key: :receiver_id, class_name: "Runner"
	validates :sender_id, :presence => {:message => 'Sender cannot be blank, Message not saved'}
	validates :receiver_id, :presence => {:message => 'Receiver cannot be blank, Message not saved'}
	validates :message, :presence => {:message => 'Message cannot be blank, Message not saved'}

	scope :unread, lambda { |user| where(receiver: user, status: Message::STATUS[:created]) }

	STATUS = {:created => 0, :rejected => 1, :approved => 2}
end
