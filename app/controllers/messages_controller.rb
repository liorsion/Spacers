class MessagesController < ApplicationController
	before_filter :authenticate_runner!

	def index
		@messages = Message.where(receiver: current_runner, status: Message::STATUS[:created])
	end

	def show
	end
end
