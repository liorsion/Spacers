class Runner < ActiveRecord::Base
  # Include default devise modules. Others available are:
  # :token_authenticatable, :confirmable,
  # :lockable, :timeoutable and :omniauthable
  devise :database_authenticatable, :registerable, :confirmable,
         :recoverable, :rememberable, :trackable, :validatable
	has_many :races, :through => :participations
	has_many :participations #, :select => "runners.*,participations.speed, participations.knowledge"
	has_many :messages, foreign_key: :receiver_id

	# scope :racers, lambda { |race| joins(:participations).where ("race_id=%d and racer=true" % [race.id])}
	# scope :pacers, lambda { |race| joins(:participations).where ("race_id=%d and racer=false" % [race.id])}

	scope :racers, -> {where ("racer=true")}
	scope :pacers, -> {where ("racer=false")}

	def username
		return "#{self.firstName} #{self.lastName}" if self.firstName
		self.email
	end
end
