package Repos;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;

public class AddStudentInst extends BasePage{

	public AddStudentInst() {
		super("insert url here");
	}
	
	public static WebElement AddStudentButton (WebDriver driver) {
		return driver.findElement(By.id("addStudentEmails"));
	}
		
	public static WebElement AddInstructorButton (WebDriver driver) {
		return driver.findElement(By.id("addInstructorEmails"));
	}
	
	public static WebElement EnterEmailAddress(WebDriver driver) {
		return driver.findElement(By.xpath(".//*[@id='email[]']"));
	}
			
	public static WebElement Submit(WebDriver driver) {
		return driver.findElement(By.cssSelector("button[type='submit']"));
	}

	public void AddingStudent (WebDriver driver) {
		AddStudentInst.EnterEmailAddress(driver).sendKeys("");
		AddStudentInst.Submit(driver).click();
	}	
		
	public void AddingInstuctor (WebDriver driver) {
		AddStudentInst.EnterEmailAddress(driver).sendKeys("");
		AddStudentInst.Submit(driver).click();
	}	
		
	}


