package Repos;

import org.openqa.selenium.WebDriver;

public class BasePage {
	private static String BaseUrl = "http://wechart2.herokuapp.com";
	
	protected static void GoToPageUrl(WebDriver driver, String PagePath) {
		driver.get(BaseUrl + PagePath);
	}
}
