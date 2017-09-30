package Repos;

import org.openqa.selenium.WebDriver;

public class BasePage {
	protected static String Url;
	
	public BasePage(String pageUrl) {
		BasePage.Url = pageUrl;
	}
	
	public static void GoToPageUrl(WebDriver driver) {
		driver.get(Url);
	}
}
