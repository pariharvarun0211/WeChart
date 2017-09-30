package Repos;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;


public class LoginPage extends BasePage {

	private static String Url = "/";
	
	public static void GoToPage(WebDriver driver) {
		BasePage.GoToPageUrl(driver, Url);
	}
	
	public static WebElement UserName(WebDriver driver) {
		return driver.findElement(By.id("email"));
	}
		
	public static WebElement Password(WebDriver driver) {
		return driver.findElement(By.id("password"));
	}
	
	public static WebElement Submit(WebDriver driver) {
		return driver.findElement(By.cssSelector("button[type='submit']"));
	}
	
	public void LoginAsStudent(WebDriver driver) {
		LoginPage.UserName(driver).sendKeys("");
		LoginPage.Password(driver).sendKeys("");
		LoginPage.Submit(driver).click();
	}
	
	public void LoginAsAdmin(WebDriver driver) {
		LoginPage.UserName(driver).sendKeys("");
		LoginPage.Password(driver).sendKeys("");
		LoginPage.Submit(driver).click();
	}
	
	public void LoginAsInstructor(WebDriver driver) {
		LoginPage.UserName(driver).sendKeys("");
		LoginPage.Password(driver).sendKeys("");
		LoginPage.Submit(driver).click();
	}
	
}
