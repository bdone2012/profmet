class SurveycodesController < ApplicationController
    def index

  end

def new
    @surveycode = Surveycode.new
    # @survey_update = Surveylink.new
    @surveylink = Surveylink.where("completed > started").first
    @surveylink.update(started: @surveylink.started + 1)
end


  def create
    @surveycode = Surveycode.new(surveycode_params)
    @surveylink = Surveylink.where("completed > started").first

    if @surveycode.save
      # Publish post data
       binding.pry
       redirect_to @surveycode, notice: 'Surveycode was successfully created.'

    else
      render :new
    end
end

  def update
    # @surveylink = Surveylink.where("completed > started").first
  #   @surveylink =  Surveylink.where("completed > started").first
  #   @update_surveylink = @surveylink.update(started: @surveylink.started - 1)
   end

   def show

  end

  def show
  end

  def surveycode_params
    # binding.pry
    params.require(:surveycode).permit(
      :surveycode,
      :surveylink_id
    )
  end
end
