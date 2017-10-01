package Repos;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AdminHome extends BasePage{

	public AdminHome() {
		super("http://wechart2.herokuapp.com/home");
	}
	
	public static WebElement AdminDashboardName(WebDriver driver) {
		return driver.findElement(By.tagName("h3"));
	}
	
	public static WebElement AdminLogOutStep1(WebDriver driver) {
		return driver.findElement(By.xpath("//a[@href='#']"));
	}
	
	public static WebElement AdminLogOutStep2(WebDriver driver) {
		return driver.findElement(By.linkText("Logout"));
	}
	
}
