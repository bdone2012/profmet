class SurveyLinkMailer < ActionMailer::Base
  default from: "professormetrics@gmail.com"

  def welcome_email(surveylink)
    @surveylink = surveylink
    @email = 'bdone2012@gmail.com'
    mail(to: @email, subject: 'Welcome to My Awesome Site')
end
end
