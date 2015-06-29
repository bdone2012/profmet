class SurveycodesController < ApplicationController
    def index

  end

def new
    @surveycode = Surveycode.new
    @surveylink = Surveylink.where("participant > started").first
  end


  def create
    @surveycode = Surveycode.new(surveycode_params)


    if @surveycode.save
      # Publish post data
      Publisher.publish("surveycodes", @surveycode.attributes)
       redirect_to @surveycode, notice: 'Surveycode was successfully created.'
       binding.pry
    else
      render :new
    end
end

  def update

  end

   def show

  end

  def show
  end

  def surveycode_params
    params.require(:surveycode).permit(
      :surveycode
    )
  end
end
